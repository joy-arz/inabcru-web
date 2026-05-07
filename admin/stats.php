<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/api.php';

checkAdminAuth();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'create' || $_POST['action'] === 'update') {
            $id = $_POST['id'] ?? null;
            $data = [
                'label' => $_POST['label'],
                'value' => $_POST['value'],
                'unit' => $_POST['unit'],
                'display_order' => (int)($_POST['display_order'] ?? 0)
            ];

            if ($_POST['action'] === 'create') {
                $result = postApi('/admin/stats', $data, true);
            } else {
                $result = putApi('/admin/stats/' . $id, $data, true);
            }

            if ($result && !isset($result['error'])) {
                $success = $_POST['action'] === 'create' ? 'Stat created successfully' : 'Stat updated successfully';
            } else {
                $error = $result['error'] ?? 'Failed to save stat';
            }
        } elseif ($_POST['action'] === 'delete') {
            $id = $_POST['id'];
            $result = deleteApi('/admin/stats/' . $id, true);
            if ($result && !isset($result['error'])) {
                $success = 'Stat deleted successfully';
            } else {
                $error = $result['error'] ?? 'Failed to delete stat';
            }
        }
    }
}

$stats = getApi('/admin/stats', true) ?? [];

$content = '
<div class="page-header">
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <div>
      <h1>Impact Stats</h1>
      <p>Manage the statistics displayed on the homepage</p>
    </div>
    <button class="btn btn-primary" onclick="openModal(\'create\')">
      <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
      </svg>
      Add Stat
    </button>
  </div>
</div>';

if ($error) {
    $content .= '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
}
if ($success) {
    $content .= '<div class="alert alert-success">' . htmlspecialchars($success) . '</div>';
}

$content .= '
<div class="card">
  <div class="card-body" style="padding: 0;">
    <table class="data-table">
      <thead>
        <tr>
          <th>Order</th>
          <th>Label</th>
          <th>Value</th>
          <th>Unit</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>';

if (!empty($stats)):
    foreach ($stats as $stat):
        $content .= '<tr>
          <td>' . ($stat['display_order'] ?? 0) . '</td>
          <td class="item-name">' . htmlspecialchars($stat['label'] ?? '') . '</td>
          <td><strong>' . htmlspecialchars($stat['display_value'] ?? $stat['value'] ?? '') . '</strong></td>
          <td><span class="badge badge-primary">' . htmlspecialchars($stat['unit'] ?? 'N/A') . '</span></td>
          <td class="actions">
            <button class="edit-btn" onclick="openModal(\'edit\', \'' . $stat['id'] . '\', \'' . addslashes($stat['label']) . '\', \'' . addslashes($stat['value'] ?? '') . '\', \'' . addslashes($stat['unit'] ?? '') . '\', \'' . ($stat['display_order'] ?? 0) . '\')">Edit</button>
            <button class="delete-btn" onclick="confirmDelete(\'' . $stat['id'] . '\', \'' . addslashes($stat['label']) . '\')">Delete</button>
          </td>
        </tr>';
    endforeach;
else:
    $content .= '<tr><td colspan="5" style="text-align: center; color: var(--muted);">No stats yet</td></tr>';
endif;

$content .= '</tbody>
    </table>
  </div>
</div>

<div id="statModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2 id="modalTitle">Add Stat</h2>
      <button class="modal-close" onclick="closeModal()">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
    <form method="POST">
      <input type="hidden" name="action" id="formAction" value="create">
      <input type="hidden" name="id" id="formId">

      <div class="form-group">
        <label>Label</label>
        <input type="text" name="label" id="formLabel" placeholder="e.g., Spesies Disurvei" required>
      </div>

      <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <div>
          <label>Value</label>
          <input type="text" name="value" id="formValue" placeholder="e.g., 45" required>
        </div>
        <div>
          <label>Unit</label>
          <input type="text" name="unit" id="formUnit" placeholder="e.g., +">
        </div>
      </div>

      <div class="form-group">
        <label>Display Order</label>
        <input type="number" name="display_order" id="formOrder" value="0" min="0">
      </div>

      <div class="form-actions">
        <button type="button" class="btn btn-outline" onclick="closeModal()">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>

<div id="deleteModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Delete Stat</h2>
      <button class="modal-close" onclick="closeDeleteModal()">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
    <p id="deleteMessage">Are you sure you want to delete this stat?</p>
    <form method="POST" style="margin-top: 24px;">
      <input type="hidden" name="action" value="delete">
      <input type="hidden" name="id" id="deleteId">
      <div class="form-actions">
        <button type="button" class="btn btn-outline" onclick="closeDeleteModal()">Cancel</button>
        <button type="submit" class="btn btn-danger" style="background: var(--danger); color: white;">Delete</button>
      </div>
    </form>
  </div>
</div>

<style>
.alert {
  padding: 16px 20px;
  border-radius: 12px;
  margin-bottom: 24px;
}
.alert-danger {
  background: #fef2f2;
  color: #dc2626;
  border: 1px solid #fecaca;
}
.alert-success {
  background: #f0fdf4;
  color: #16a34a;
  border: 1px solid #bbf7d0;
}
.btn-danger {
  border: none;
}
</style>

<script>
function openModal(action, id, label, value, unit, order) {
  document.getElementById(\'statModal\').classList.add(\'active\');
  document.getElementById(\'formAction\').value = action;
  document.getElementById(\'formId\').value = id || \'\';
  document.getElementById(\'formLabel\').value = label || \'\';
  document.getElementById(\'formValue\').value = value || \'\';
  document.getElementById(\'formUnit\').value = unit || \'\';
  document.getElementById(\'formOrder\').value = order || 0;
  document.getElementById(\'modalTitle\').textContent = action === \'create\' ? \'Add Stat\' : \'Edit Stat\';
}

function closeModal() {
  document.getElementById(\'statModal\').classList.remove(\'active\');
}

function confirmDelete(id, label) {
  document.getElementById(\'deleteModal\').classList.add(\'active\');
  document.getElementById(\'deleteId\').value = id;
  document.getElementById(\'deleteMessage\').textContent = \'Are you sure you want to delete "\' + label + \'"?\';
}

function closeDeleteModal() {
  document.getElementById(\'deleteModal\').classList.remove(\'active\');
}
</script>';

include __DIR__ . '/../admin/includes/layout.php';