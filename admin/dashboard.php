<?php
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/api.php';

checkAdminAuth();

$stats = getApi('/admin/stats', true) ?? [];
$recentPublications = getApi('/publications') ?? [];
$recentArticles = getApi('/articles') ?? [];
$team = getApi('/team') ?? [];

$content = '
<div class="page-header">
  <h1>Dashboard</h1>
  <p>Welcome to InaBCRU Admin Panel</p>
</div>

<div class="stats-grid">
  <div class="stat-card primary">
    <div class="stat-icon">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
      </svg>
    </div>
    <div class="stat-value">' . count($recentPublications) . '</div>
    <div class="stat-label">Publications</div>
  </div>

  <div class="stat-card cta">
    <div class="stat-icon">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
      </svg>
    </div>
    <div class="stat-value">' . count($recentArticles) . '</div>
    <div class="stat-label">Articles</div>
  </div>

  <div class="stat-card success">
    <div class="stat-icon">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
      </svg>
    </div>
    <div class="stat-value">' . count($team) . '</div>
    <div class="stat-label">Team Members</div>
  </div>

  <div class="stat-card danger">
    <div class="stat-icon">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
      </svg>
    </div>
    <div class="stat-value">' . (isset($stats[0]['display_value']) ? $stats[0]['display_value'] : '0') . '</div>
    <div class="stat-label">Impact Stats</div>
  </div>
</div>

<div class="dashboard-grid">
  <div class="card">
    <div class="card-header">
      <h2>Recent Publications</h2>
      <a href="publications.php" class="btn btn-outline btn-sm">View All</a>
    </div>
    <div class="card-body" style="padding: 0;">
      <table class="data-table">
        <thead>
          <tr>
            <th>Title</th>
            <th>Journal</th>
            <th>Year</th>
          </tr>
        </thead>
        <tbody>';
          $pubCount = 0;
          foreach ($recentPublications as $pub):
            if ($pubCount >= 5) break;
            $content .= '<tr>
              <td class="item-name">' . htmlspecialchars($pub['title'] ?? '') . '</td>
              <td>' . htmlspecialchars($pub['journal'] ?? '') . '</td>
              <td>' . ($pub['year'] ?? '') . '</td>
            </tr>';
            $pubCount++;
          endforeach;
          if ($pubCount == 0):
            $content .= '<tr><td colspan="3" style="text-align:center;color:var(--muted);">No publications yet</td></tr>';
          endif;
$content .= '</tbody>
      </table>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h2>Team Members</h2>
      <a href="team.php" class="btn btn-outline btn-sm">Manage</a>
    </div>
    <div class="card-body" style="padding: 0;">
      <table class="data-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Title</th>
            <th>Unit</th>
          </tr>
        </thead>
        <tbody>';
          $teamCount = 0;
          foreach ($team as $member):
            if ($teamCount >= 5) break;
            $content .= '<tr>
              <td class="item-name">' . htmlspecialchars($member['name'] ?? '') . '</td>
              <td>' . htmlspecialchars($member['title'] ?? '') . '</td>
              <td><span class="badge badge-primary">' . htmlspecialchars($member['unit'] ?? 'N/A') . '</span></td>
            </tr>';
            $teamCount++;
          endforeach;
          if ($teamCount == 0):
            $content .= '<tr><td colspan="3" style="text-align:center;color:var(--muted);">No team members yet</td></tr>';
          endif;
$content .= '</tbody>
      </table>
    </div>
  </div>
</div>

<style>
.dashboard-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 24px;
}
</style>
';

include __DIR__ . '/../admin/includes/layout.php';