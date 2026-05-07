<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/api.php';

checkAdminAuth();

$stats = getApi('/admin/stats', true) ?? [];
$recentPublications = getApi('/publications') ?? [];
$recentArticles = getApi('/articles') ?? [];
$team = getApi('/team') ?? [];

$pubCount = count($recentPublications);
$articleCount = count($recentArticles);
$teamCount = count($team);

$content = '
<div class="page-header">
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <div>
      <h1>Dashboard</h1>
      <p>Welcome back to InaBCRU Admin Panel</p>
    </div>
    <div style="display: flex; align-items: center; gap: 8px; font-size: 14px; color: var(--muted);">
      <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
      </svg>
      <span>System operational</span>
    </div>
  </div>
</div>

<div class="stats-grid">
  <a href="' . BASE_URL . '/admin/publications" class="stat-card-link">
    <div class="stat-card primary">
      <div class="stat-card-gradient"></div>
      <div class="stat-card-content">
        <div class="stat-icon">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
          </svg>
        </div>
        <p class="stat-value">' . $pubCount . '</p>
        <p class="stat-label">Publications</p>
        <div class="stat-action">
          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
          </svg>
          View all
          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
          </svg>
        </div>
      </div>
    </div>
  </a>

  <a href="' . BASE_URL . '/admin/articles" class="stat-card-link">
    <div class="stat-card cta">
      <div class="stat-card-gradient"></div>
      <div class="stat-card-content">
        <div class="stat-icon">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
          </svg>
        </div>
        <p class="stat-value">' . $articleCount . '</p>
        <p class="stat-label">Articles</p>
        <div class="stat-action">
          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
          </svg>
          View all
          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
          </svg>
        </div>
      </div>
    </div>
  </a>

  <a href="' . BASE_URL . '/admin/team" class="stat-card-link">
    <div class="stat-card success">
      <div class="stat-card-gradient"></div>
      <div class="stat-card-content">
        <div class="stat-icon">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
          </svg>
        </div>
        <p class="stat-value">' . $teamCount . '</p>
        <p class="stat-label">Team Members</p>
        <div class="stat-action">
          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
          </svg>
          View all
          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
          </svg>
        </div>
      </div>
    </div>
  </a>

  <a href="' . BASE_URL . '/admin/stats" class="stat-card-link">
    <div class="stat-card danger">
      <div class="stat-card-gradient"></div>
      <div class="stat-card-content">
        <div class="stat-icon">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
          </svg>
        </div>
        <p class="stat-value">' . count($stats) . '</p>
        <p class="stat-label">Impact Stats</p>
        <div class="stat-action">
          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
          </svg>
          Edit
          <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
          </svg>
        </div>
      </div>
    </div>
  </a>
</div>

<div class="dashboard-grid">
  <div class="card">
    <div class="card-header">
      <h2>Recent Publications</h2>
      <a href="' . BASE_URL . '/admin/publications" class="text-link">View all</a>
    </div>
    <div class="card-body-list">';

if (!empty($recentPublications)):
  $showPubs = array_slice($recentPublications, 0, 5);
  foreach ($showPubs as $pub):
    $date = isset($pub['created_at']) ? date('M j, Y', strtotime($pub['created_at'])) : date('M j, Y');
    $content .= '<div class="list-item">
      <div class="list-icon pub-icon">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
        </svg>
      </div>
      <div class="list-content">
        <p class="list-title">' . htmlspecialchars($pub['title'] ?? '') . '</p>
        <p class="list-date">' . $date . '</p>
      </div>
    </div>';
  endforeach;
else:
  $content .= '<div class="empty-state">
    <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
    </svg>
    <p>No publications yet</p>
    <a href="' . BASE_URL . '/admin/publications/new" class="empty-link">Create your first publication</a>
  </div>';
endif;

$content .= '</div>
  </div>

  <div class="card">
    <div class="card-header">
      <h2>Recent Articles</h2>
      <a href="' . BASE_URL . '/admin/articles" class="text-link">View all</a>
    </div>
    <div class="card-body-list">';

if (!empty($recentArticles)):
  $showArticles = array_slice($recentArticles, 0, 5);
  foreach ($showArticles as $article):
    $date = isset($article['created_at']) ? date('M j, Y', strtotime($article['created_at'])) : date('M j, Y');
    $content .= '<div class="list-item">
      <div class="list-icon article-icon">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
        </svg>
      </div>
      <div class="list-content">
        <p class="list-title">' . htmlspecialchars($article['title'] ?? '') . '</p>
        <p class="list-date">' . $date . '</p>
      </div>
    </div>';
  endforeach;
else:
  $content .= '<div class="empty-state">
    <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
    </svg>
    <p>No articles yet</p>
    <a href="' . BASE_URL . '/admin/articles/new" class="empty-link">Create your first article</a>
  </div>';
endif;

$content .= '</div>
  </div>
</div>

<div class="card" style="margin-top: 24px;">
  <div class="card-header">
    <h2>Quick Actions</h2>
  </div>
  <div class="quick-actions-grid">
    <a href="' . BASE_URL . '/admin/publications/new" class="quick-action">
      <div class="quick-action-icon blue">
        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
      </div>
      <p>New Publication</p>
    </a>
    <a href="' . BASE_URL . '/admin/articles/new" class="quick-action">
      <div class="quick-action-icon green">
        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
      </div>
      <p>New Article</p>
    </a>
    <a href="' . BASE_URL . '/admin/team/new" class="quick-action">
      <div class="quick-action-icon purple">
        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
      </div>
      <p>Add Team Member</p>
    </a>
    <a href="' . BASE_URL . '/admin/stats" class="quick-action">
      <div class="quick-action-icon amber">
        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
        </svg>
      </div>
      <p>Edit Stats</p>
    </a>
  </div>
</div>

<style>
.stat-card-link {
  text-decoration: none;
}

.stat-card {
  position: relative;
  overflow: hidden;
}

.stat-card-gradient {
  position: absolute;
  top: 0;
  right: 0;
  width: 96px;
  height: 96px;
  background: linear-gradient(135deg, var(--background) 0%, transparent 100%);
  border-radius: 0 16px 0 100%;
}

.stat-card-content {
  position: relative;
  z-index: 1;
}

.stat-action {
  display: flex;
  align-items: center;
  gap: 4px;
  margin-top: 16px;
  font-size: 14px;
  color: var(--muted);
  transition: color 0.2s;
}

.stat-card:hover .stat-action {
  color: var(--text);
}

.stat-card:hover .stat-action svg:last-child {
  transform: translateX(4px);
  transition: transform 0.2s;
}

.dashboard-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 24px;
}

.card-body-list {
  padding: 8px 0;
}

.list-item {
  display: flex;
  align-items: center;
  gap: 16px;
  padding: 12px 24px;
  transition: background 0.2s;
  cursor: pointer;
}

.list-item:hover {
  background: var(--background);
}

.list-icon {
  width: 40px;
  height: 40px;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.pub-icon {
  background: var(--primary-light);
  color: var(--primary);
}

.article-icon {
  background: rgba(34, 197, 94, 0.1);
  color: var(--success);
}

.list-content {
  flex: 1;
  min-width: 0;
}

.list-title {
  font-weight: 500;
  color: var(--text);
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.list-date {
  font-size: 12px;
  color: var(--muted);
  margin-top: 2px;
}

.text-link {
  color: var(--primary);
  font-size: 14px;
  font-weight: 500;
  text-decoration: none;
}

.text-link:hover {
  color: #1e2a5c;
}

.empty-state {
  padding: 32px;
  text-align: center;
  color: var(--muted);
}

.empty-state svg {
  margin: 0 auto 12px;
  color: #d1d5db;
}

.empty-link {
  display: inline-block;
  margin-top: 8px;
  color: var(--primary);
  font-size: 14px;
  font-weight: 500;
  text-decoration: none;
}

.empty-link:hover {
  text-decoration: underline;
}

.quick-actions-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
  padding: 20px 24px;
}

.quick-action {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  border: 2px dashed var(--border);
  border-radius: 12px;
  text-decoration: none;
  transition: all 0.2s;
}

.quick-action:hover {
  border-color: var(--primary);
  background: var(--primary-light);
}

.quick-action-icon {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 12px;
  transition: background 0.2s;
}

.quick-action:hover .quick-action-icon {
  transform: scale(1.05);
}

.quick-action-icon.blue {
  background: #eff6ff;
  color: #3b82f6;
}

.quick-action:hover .quick-action-icon.blue {
  background: #dbeafe;
}

.quick-action-icon.green {
  background: #f0fdf4;
  color: #22c55e;
}

.quick-action:hover .quick-action-icon.green {
  background: #dcfce7;
}

.quick-action-icon.purple {
  background: #faf5ff;
  color: #a855f7;
}

.quick-action:hover .quick-action-icon.purple {
  background: #f3e8ff;
}

.quick-action-icon.amber {
  background: #fffbeb;
  color: #f59e0b;
}

.quick-action:hover .quick-action-icon.amber {
  background: #fef3c7;
}

.quick-action p {
  font-size: 14px;
  font-weight: 500;
  color: #6b7280;
}

.quick-action:hover p {
  color: var(--text);
}

@media (max-width: 1024px) {
  .quick-actions-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

@media (max-width: 768px) {
  .dashboard-grid {
    grid-template-columns: 1fr;
  }
}
</style>';

include __DIR__ . '/../admin/includes/layout.php';