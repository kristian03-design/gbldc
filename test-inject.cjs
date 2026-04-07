const fs = require('fs');
let content = fs.readFileSync('c:/xampp/htdocs/gbldc-1/resources/views/Administrator/Admindashboard.blade.php', 'utf8');

const m = content.match(/(<header class="topbar">[\s\n]*<div([^>]*)>)/i);
if(m) {
  console.log('Matched:', m[1]);
  const replaced = content.replace(m[1], `<div class="sidebar-overlay" id="sidebar-overlay" onclick="document.getElementById('sidebar').classList.remove('open'); document.getElementById('sidebar-overlay').classList.remove('show');"></div>\n<header class="topbar">\n  <div${m[2]} style="display:flex; align-items:center;">\n    <button class="mobile-toggle" id="mobile-toggle" onclick="document.getElementById('sidebar').classList.add('open'); document.getElementById('sidebar-overlay').classList.add('show');" style="margin-right:12px;">\n      <svg width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg>\n    </button>`);
  console.log('Replacement preview:\n', replaced.substring(content.indexOf('<header class="topbar">') - 50, content.indexOf('<header class="topbar">') + 500));
} else {
  console.log('Not matched');
}
