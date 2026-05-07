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
                'slug' => $_POST['slug'],
                'content' => $_POST['content'],
                'excerpt' => $_POST['excerpt'],
                'cover_image' => $_POST['cover_image'] ?? null,
                'author' => $_POST['author'],
                'category' => $_POST['category'],
                'published' => isset($_POST['published']) ? 1 : 0
            ];

            if ($_POST['action'] === 'create') {
                $result = postApi('/admin/articles', $data, true);
            } else {
                $result = putApi('/admin/articles/' . $id, $data, true);
            }

            if ($result && !isset($result['error'])) {
                $success = $_POST['action'] === 'create' ? 'Article created successfully' : 'Article updated successfully';
            } else {
                $error = $result['error'] ?? 'Failed to save article';
            }
        } elseif ($_POST['action'] === 'delete') {
            $id = $_POST['id'];
            $result = deleteApi('/admin/articles/' . $id, true);
            if ($result && !isset($result['error'])) {
                $success = 'Article deleted successfully';
            } else {
                $error = $result['error'] ?? 'Failed to delete article';
            }
        }
    }
}

$articles = getApi('/articles') ?? [];

$content = '
<div class="page-header">
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <div>
      <h1>Articles</h1>
      <p>Manage news articles and blog posts</p>
    </div>
    <button class="btn btn-primary" onclick="openModal(\'create\')">
      <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
      </svg>
      Add Article
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
          <th>Author</th>
          <th>Category</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>';

if (!empty($articles)):
    foreach ($articles as $article):
        $published = $article['published'] ?? false;
        $content .= '<tr>
          <td><img src="' . htmlspecialchars($article['cover_image'] ?? 'https://via.placeholder.com/48') . '" alt="" class="item-image"></td>
          <td class="item-name">' . htmlspecialchars($article['title'] ?? '') . '</td>
          <td>' . htmlspecialchars($article['author'] ?? '') . '</td>
          <td><span class="badge badge-primary">' . htmlspecialchars($article['category'] ?? 'General') . '</span></td>
          <td><span class="badge ' . ($published ? 'badge-success' : 'badge-cta') . '">' . ($published ? 'Published' : 'Draft') . '</span></td>
          <td class="actions">
            <button class="edit-btn" onclick="openModal(\'edit\', \'' . $article['id'] . '\', \'' . addslashes($article['title']) . '\', \'' . addslashes($article['slug']) . '\', \'' . addslashes($article['content'] ?? '') . '\', \'' . addslashes($article['excerpt'] ?? '') . '\', \'' . addslashes($article['cover_image'] ?? '') . '\', \'' . addslashes($article['author']) . '\', \'' . addslashes($article['category']) . '\', \'' . ($published ? '1' : '0') . '\')">Edit</button>
            <button class="delete-btn" onclick="confirmDelete(\'' . $article['id'] . '\', \'' . addslashes($article['title']) . '\')">Delete</button>
          </td>
        </tr>';
    endforeach;
else:
    $content .= '<tr><td colspan="6" style="text-align: center; color: var(--muted);">No articles yet</td></tr>';
endif;

$content .= '</tbody>
    </table>
  </div>
</div>

<div id="articleModal" class="modal">
  <div class="modal-content" style="max-width: 600px;">
    <div class="modal-header">
      <h2 id="modalTitle">Add Article</h2>
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
        <label>Slug</label>
        <input type="text" name="slug" id="formSlug" required>
      </div>

      <div class="form-group">
        <label>Content</label>
        <textarea name="content" id="formContent" rows="5"></textarea>
      </div>

      <div class="form-group">
        <label>Excerpt</label>
        <textarea name="excerpt" id="formExcerpt" rows="2"></textarea>
      </div>

      <div class="form-group">
        <label>Cover Image URL</label>
        <input type="url" name="cover_image" id="formCover">
      </div>

      <div class="form-group">
        <label>Author</label>
        <input type="text" name="author" id="formAuthor" required>
      </div>

      <div class="form-group">
        <label>Category</label>
        <input type="text" name="category" id="formCategory" value="General">
      </div>

      <div class="form-group">
        <label style="display: flex; align-items: center; gap: 8px;">
          <input type="checkbox" name="published" id="formPublished" style="width: auto;">
          Published
        </label>
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
      <h2>Delete Article</h2>
      <button class="modal-close" onclick="closeDeleteModal()">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>
    <p id="deleteMessage">Are you sure you want to delete this article?</p>
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
function openModal(action, id, title, slug, content, excerpt, cover, author, category, published) {
  document.getElementById(\'articleModal\').classList.add(\'active\');
  document.getElementById(\'formAction\').value = action;
  document.getElementById(\'formId\').value = id || \'\';
  document.getElementById(\'formTitle\').value = title || \'\';
  document.getElementById(\'formSlug\').value = slug || \'\';
  document.getElementById(\'formContent\').value = content || \'\';
  document.getElementById(\'formExcerpt\').value = excerpt || \'\';
  document.getElementById(\'formCover\').value = cover || \'\';
  document.getElementById(\'formAuthor\').value = author || \'\';
  document.getElementById(\'formCategory\').value = category || \'General\';
  document.getElementById(\'formPublished\').checked = published === \'1\';
  document.getElementById(\'modalTitle\').textContent = action === \'create\' ? \'Add Article\' : \'Edit Article\';
}

function closeModal() {
  document.getElementById(\'articleModal\').classList.remove(\'active\');
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