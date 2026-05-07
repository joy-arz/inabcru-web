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
                'title' => $_POST['title'],
                'journal' => $_POST['journal'],
                'year' => (int)$_POST['year'],
                'date' => $_POST['date'],
                'doi' => $_POST['doi'] ?? null,
                'abstract' => $_POST['abstract'] ?? null,
                'cover_image' => $_POST['cover_image'] ?? null
            ];

            if ($_POST['action'] === 'create') {
                $result = postApi('/admin/publications', $data, true);
            } else {
                $result = putApi('/admin/publications/' . $id, $data, true);
            }

            if ($result && !isset($result['error'])) {
                $success = $_POST['action'] === 'create' ? 'Publication created successfully' : 'Publication updated successfully';
            } else {
                $error = $result['error'] ?? 'Failed to save publication';
            }
        } elseif ($_POST['action'] === 'delete') {
            $id = $_POST['id'];
            $result = deleteApi('/admin/publications/' . $id, true);
            if ($result && !isset($result['error'])) {
                $success = 'Publication deleted successfully';
            } else {
                $error = $result['error'] ?? 'Failed to delete publication';
            }
        }
    }
}

$publications = getApi('/publications') ?? [];

$content = '
<div class="page-header">
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <div>
      <h1>Publications</h1>
      <p>Manage scientific publications and research papers</p>
    </div>
    <button class="btn btn-primary" onclick="openModal(\'create\')">
      <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
      </svg>
      Add Publication
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
          <th>Cover</th>
          <th>Title</th>
          <th>Journal</th>
          <th>Year</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>';

if (!empty($publications)):
    foreach ($publications as $pub):
        $content .= '<tr>
          <td><img src="' . htmlspecialchars($pub['cover_image'] ?? 'https://via.placeholder.com/48') . '" alt="" class="item-image"></td>
          <td class="item-name">' . htmlspecialchars($pub['title'] ?? '') . '</td>
          <td>' . htmlspecialchars($pub['journal'] ?? '') . '</td>
          <td>' . ($pub['year'] ?? '') . '</td>
          <td class="actions">
            <button class="edit-btn" onclick="openModal(\'edit\', \'' . $pub['id'] . '\', \'' . addslashes($pub['title']) . '\', \'' . addslashes($pub['journal']) . '\', \'' . $pub['year'] . '\', \'' . $pub['date'] . '\', \'' . addslashes($pub['doi'] ?? '') . '\', \'' . addslashes($pub['abstract'] ?? '') . '\', \'' . addslashes($pub['cover_image'] ?? '') . '\')">Edit</button>
            <button class="delete-btn" onclick="confirmDelete(\'' . $pub['id'] . '\', \'' . addslashes($pub['title']) . '\')">Delete</button>
          </td>
        </tr>';
    endforeach;
else:
    $content .= '<tr><td colspan="5" style="text-align: center; color: var(--muted);">No publications yet</td></tr>';
endif;

$content .= '</tbody>
    </table>
  </div>
</div>

<div id="pubModal" class="modal">
  <div class="modal-content" style="max-width: 600px;">
    <div class="modal-header">
      <h2 id="modalTitle">Add Publication</h2>
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
        <label>Title</label>
        <input type="text" name="title" id="formTitle" required>
      </div>

      <div class="form-group">
        <label>Journal</label>
        <input type="text" name="journal" id="formJournal" required>
      </div>

      <div class="form-group" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
        <div>
          <label>Year</label>
          <input type="number" name="year" id="formYear" min="1900" max="2100" required>
        </div>
        <div>
          <label>Date</label>
          <input type="date" name="date" id="formDate">
        </div>
      </div>

      <div class="form-group">
        <label>DOI</label>
        <input type="url" name="doi" id="formDoi" placeholder="https://doi.org/...">
      </div>

      <div class="form-group">
        <label>Abstract</label>
        <textarea name="abstract" id="formAbstract" rows="4"></textarea>
      </div>

      <div class="form-group">
        <label>Cover Image URL</label>
        <input type="url" name="cover_image" id="formCover">
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
      <h2>Delete Publication</h2>
      <button class="modal-close" onclick="closeDeleteModal()">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
    <p id="deleteMessage">Are you sure you want to delete this publication?</p>
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
function openModal(action, id, title, journal, year, date, doi, abstract, cover) {
  document.getElementById(\'pubModal\').classList.add(\'active\');
  document.getElementById(\'formAction\').value = action;
  document.getElementById(\'formId\').value = id || \'\';
  document.getElementById(\'formTitle\').value = title || \'\';
  document.getElementById(\'formJournal\').value = journal || \'\';
  document.getElementById(\'formYear\').value = year || new Date().getFullYear();
  document.getElementById(\'formDate\').value = date || \'\';
  document.getElementById(\'formDoi\').value = doi || \'\';
  document.getElementById(\'formAbstract\').value = abstract || \'\';
  document.getElementById(\'formCover\').value = cover || \'\';
  document.getElementById(\'modalTitle\').textContent = action === \'create\' ? \'Add Publication\' : \'Edit Publication\';
}

function closeModal() {
  document.getElementById(\'pubModal\').classList.remove(\'active\');
}

function confirmDelete(id, title) {
  document.getElementById(\'deleteModal\').classList.add(\'active\');
  document.getElementById(\'deleteId\').value = id;
  document.getElementById(\'deleteMessage\').textContent = \'Are you sure you want to delete "\' + title + \'"?\';
}

function closeDeleteModal() {
  document.getElementById(\'deleteModal\').classList.remove(\'active\');
}
</script>';

include __DIR__ . '/../admin/includes/layout.php';