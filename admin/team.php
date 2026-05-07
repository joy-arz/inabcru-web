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
                'name' => $_POST['name'],
                'title' => $_POST['title'],
                'unit' => $_POST['unit'],
                'bio' => $_POST['bio'],
                'display_order' => (int)($_POST['display_order'] ?? 0),
                'photo_url' => $_POST['photo_url'] ?? null
            ];

            if ($_POST['action'] === 'create') {
                $result = postApi('/admin/team', $data, true);
            } else {
                $result = putApi('/admin/team/' . $id, $data, true);
            }

            if ($result && !isset($result['error'])) {
                $success = $_POST['action'] === 'create' ? 'Team member created successfully' : 'Team member updated successfully';
            } else {
                $error = $result['error'] ?? 'Failed to save team member';
            }
        } elseif ($_POST['action'] === 'delete') {
            $id = $_POST['id'];
            $result = deleteApi('/admin/team/' . $id, true);
            if ($result && !isset($result['error'])) {
                $success = 'Team member deleted successfully';
            } else {
                $error = $result['error'] ?? 'Failed to delete team member';
            }
        }
    }
}

$team = getApi('/team') ?? [];

$content = '
<div class="page-header">
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <div>
      <h1>Team Members</h1>
      <p>Manage your team members and their information</p>
    </div>
    <button class="btn btn-primary" onclick="openModal(\'create\')">
      <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
      </svg>
      Add Member
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
          <th>Photo</th>
          <th>Name</th>
          <th>Title</th>
          <th>Unit</th>
          <th>Order</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>';

if (!empty($team)):
    foreach ($team as $member):
        $content .= '<tr>
          <td><img src="' . htmlspecialchars($member['photo_url'] ?? 'https://via.placeholder.com/48') . '" alt="" class="item-image"></td>
          <td class="item-name">' . htmlspecialchars($member['name'] ?? '') . '</td>
          <td>' . htmlspecialchars($member['title'] ?? '') . '</td>
          <td><span class="badge badge-primary">' . htmlspecialchars($member['unit'] ?? 'N/A') . '</span></td>
          <td>' . ($member['display_order'] ?? 0) . '</td>
          <td class="actions">
            <button class="edit-btn" onclick="openModal(\'edit\', \'' . $member['id'] . '\', \'' . addslashes($member['name']) . '\', \'' . addslashes($member['title']) . '\', \'' . addslashes($member['unit']) . '\', \'' . addslashes($member['bio'] ?? '') . '\', \'' . addslashes($member['photo_url'] ?? '') . '\', \'' . ($member['display_order'] ?? 0) . '\')">Edit</button>
            <button class="delete-btn" onclick="confirmDelete(\'' . $member['id'] . '\', \'' . addslashes($member['name']) . '\')">Delete</button>
          </td>
        </tr>';
    endforeach;
else:
    $content .= '<tr><td colspan="6" style="text-align: center; color: var(--muted);">No team members yet</td></tr>';
endif;

$content .= '</tbody>
    </table>
  </div>
</div>

<div id="memberModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2 id="modalTitle">Add Team Member</h2>
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
        <label>Name</label>
        <input type="text" name="name" id="formName" required>
      </div>

      <div class="form-group">
        <label>Title/Position</label>
        <input type="text" name="title" id="formTitle" required>
      </div>

      <div class="form-group">
        <label>Unit/Department</label>
        <input type="text" name="unit" id="formUnit" required>
      </div>

      <div class="form-group">
        <label>Bio</label>
        <textarea name="bio" id="formBio" rows="3"></textarea>
      </div>

      <div class="form-group">
        <label>Photo URL</label>
        <input type="url" name="photo_url" id="formPhoto">
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
      <h2>Delete Team Member</h2>
      <button class="modal-close" onclick="closeDeleteModal()">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
    <p id="deleteMessage">Are you sure you want to delete this team member?</p>
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
function openModal(action, id, name, title, unit, bio, photo, order) {
  document.getElementById(\'memberModal\').classList.add(\'active\');
  document.getElementById(\'formAction\').value = action;
  document.getElementById(\'formId\').value = id || \'\';
  document.getElementById(\'formName\').value = name || \'\';
  document.getElementById(\'formTitle\').value = title || \'\';
  document.getElementById(\'formUnit\').value = unit || \'\';
  document.getElementById(\'formBio\').value = bio || \'\';
  document.getElementById(\'formPhoto\').value = photo || \'\';
  document.getElementById(\'formOrder\').value = order || 0;
  document.getElementById(\'modalTitle\').textContent = action === \'create\' ? \'Add Team Member\' : \'Edit Team Member\';
}

function closeModal() {
  document.getElementById(\'memberModal\').classList.remove(\'active\');
}

function confirmDelete(id, name) {
  document.getElementById(\'deleteModal\').classList.add(\'active\');
  document.getElementById(\'deleteId\').value = id;
  document.getElementById(\'deleteMessage\').textContent = \'Are you sure you want to delete "\' + name + \'"?\';
}

function closeDeleteModal() {
  document.getElementById(\'deleteModal\').classList.remove(\'active\');
}
</script>';

include __DIR__ . '/../admin/includes/layout.php';