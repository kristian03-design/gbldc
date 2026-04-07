const fs = require('fs');
const path = require('path');

const dirs = [
  'c:/xampp/htdocs/gbldc-1/resources/views/Administrator',
  'c:/xampp/htdocs/gbldc-1/resources/views/Members'
];

const newCss = `
    /* RESPONSIVE INJECT */
    .mobile-toggle { display: none; }
    .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 99; }
    .sidebar-overlay.show { display: block; }
    @media (max-width: 900px) {
      :root { --sidebar-w: 0px !important; }
      .sidebar { transform: translateX(-100%); transition: transform 0.3s ease; width: 260px !important; z-index: 100 !important; }
      .sidebar.open { transform: translateX(0); }
      .main { margin-left: 0 !important; width: 100% !important; min-width: 100vw; overflow-x: hidden; }
      .mobile-toggle { display: flex !important; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 8px; border: none; background: #f3f4f6; color: var(--ink); cursor: pointer; position: absolute; left: 10px; top: 50%; transform: translateY(-50%); z-index: 60; }
      .topbar { padding-left: 56px !important; padding-right: 14px !important; position: relative !important; }
      .tables-grid, .stats-grid, .loan-grid, .kpi-strip, .form-grid { grid-template-columns: 1fr !important; }
      .page-body { padding: 16px !important; }
      .hide-mobile { display: none !important; }
    }
</style>
`;

let modifiedCount = 0;

function processFile(filePath) {
  let content = fs.readFileSync(filePath, 'utf8');
  let changed = false;

  // Skip if already processed completely
  if (content.includes('id="mobile-toggle"') || content.includes('id="mobileToggle"')) {
    // Optionally update CSS if we want, but let's just leave the 13 alone as they are working fine.
    return;
  }

  if (content.includes('<header class="topbar">')) {
    // 1. Replace the old RESPONSIVE INJECT CSS block if it exists
    if (content.includes('/* RESPONSIVE INJECT */')) {
      content = content.replace(/\/\*\s*RESPONSIVE INJECT\s*\*\/[\s\S]*?<\/style>/i, newCss.trim());
      changed = true;
    } else if (content.includes('</style>')) {
      content = content.replace(/<\/style>/i, newCss.trim());
      changed = true;
    }

    // 2. Inject HTML Button and Overlay right after <header class="topbar">
    const replacement = `
<div class="sidebar-overlay" id="sidebar-overlay" onclick="document.getElementById('sidebar').classList.remove('open'); document.getElementById('sidebar-overlay').classList.remove('show');"></div>
<header class="topbar">
  <button class="mobile-toggle" id="mobile-toggle" onclick="document.getElementById('sidebar').classList.add('open'); document.getElementById('sidebar-overlay').classList.add('show');">
    <svg width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
  </button>`;
    content = content.replace(/<header class="topbar">/i, replacement);
    changed = true;

    if (changed) {
      fs.writeFileSync(filePath, content, 'utf8');
      modifiedCount++;
      console.log('Processed (Absolute positioning):', path.basename(filePath));
    }
  }
}

dirs.forEach(dir => {
  if (fs.existsSync(dir)) {
    const files = fs.readdirSync(dir);
    files.forEach(file => {
      if (file.endsWith('.blade.php')) {
        processFile(path.join(dir, file));
      }
    });
  }
});
console.log('Done! Total modified:', modifiedCount);
