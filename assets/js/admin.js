(function () {
  "use strict";

  document.addEventListener("click", function (e) {
    var btn = e.target.closest(".btn-remove-row");
    if (btn) {
      var row = btn.closest(".stat-row, .skill-row, .tool-row, .soft-row, .exp-row, .edu-row, .cert-row, .project-row");
      if (row) row.remove();
    }
  });

  function addRow(containerId, html) {
    var el = document.getElementById(containerId);
    if (!el) return;
    var wrap = document.createElement("div");
    wrap.innerHTML = html.trim();
    el.appendChild(wrap.firstElementChild);
  }

  var addStat = document.getElementById("add-stat");
  if (addStat) {
    addStat.addEventListener("click", function () {
      addRow("stats-rows", '<div class="row stat-row border rounded p-2 mb-2 mx-0">' +
        '<div class="col-md-3"><input type="text" name="label[]" class="form-control" placeholder="Label"></div>' +
        '<div class="col-md-2"><input type="text" name="value[]" class="form-control" placeholder="Nilai"></div>' +
        '<div class="col-md-3"><input type="text" name="icon[]" class="form-control" placeholder="fas fa-star" value="fas fa-star"></div>' +
        '<div class="col-md-3"><select name="color[]" class="form-control"><option>bg-info</option><option>bg-success</option><option>bg-warning</option><option>bg-danger</option></select></div>' +
        '<div class="col-md-1"><button type="button" class="btn btn-danger btn-sm btn-remove-row"><i class="fas fa-trash"></i></button></div></div>');
    });
  }

  var addSkill = document.getElementById("add-skill");
  if (addSkill) {
    addSkill.addEventListener("click", function () {
      addRow("skill-rows", '<div class="row skill-row border rounded p-2 mb-2 mx-0">' +
        '<div class="col-md-4"><input type="text" name="skill_name[]" class="form-control"></div>' +
        '<div class="col-md-2"><input type="number" name="skill_percent[]" class="form-control" min="0" max="100" value="50"></div>' +
        '<div class="col-md-3"><select name="skill_color[]" class="form-control"><option>bg-info</option><option>bg-primary</option><option>bg-success</option><option>bg-warning</option></select></div>' +
        '<div class="col-md-2"><button type="button" class="btn btn-danger btn-sm btn-remove-row"><i class="fas fa-trash"></i></button></div></div>');
    });
  }

  var addTool = document.getElementById("add-tool");
  if (addTool) {
    addTool.addEventListener("click", function () {
      addRow("tool-rows", '<div class="input-group mb-2 tool-row"><input type="text" name="tool_name[]" class="form-control"><div class="input-group-append"><button type="button" class="btn btn-danger btn-remove-row"><i class="fas fa-trash"></i></button></div></div>');
    });
  }

  var addSoft = document.getElementById("add-soft");
  if (addSoft) {
    addSoft.addEventListener("click", function () {
      addRow("soft-rows", '<div class="input-group mb-2 soft-row"><input type="text" name="soft_name[]" class="form-control"><div class="input-group-append"><button type="button" class="btn btn-danger btn-remove-row"><i class="fas fa-trash"></i></button></div></div>');
    });
  }

  var addExp = document.getElementById("add-exp");
  if (addExp) {
    addExp.addEventListener("click", function () {
      addRow("exp-rows", '<div class="border rounded p-3 mb-3 exp-row"><div class="row">' +
        '<div class="col-md-3"><label>Periode</label><input type="text" name="period[]" class="form-control"></div>' +
        '<div class="col-md-9"><label>Judul</label><input type="text" name="title[]" class="form-control"></div>' +
        '<div class="col-12 mt-2"><label>Deskripsi</label><textarea name="description[]" class="form-control" rows="2"></textarea></div>' +
        '<div class="col-md-4 mt-2"><label>Icon</label><input type="text" name="icon[]" class="form-control" value="fas fa-briefcase"></div>' +
        '<div class="col-md-4 mt-2"><label>Warna</label><select name="color[]" class="form-control"><option>bg-success</option><option>bg-info</option><option>bg-warning</option></select></div>' +
        '<div class="col-md-4 mt-2 d-flex align-items-end"><button type="button" class="btn btn-danger btn-sm btn-remove-row"><i class="fas fa-trash"></i> Hapus</button></div></div></div>');
    });
  }

  var addEdu = document.getElementById("add-edu");
  if (addEdu) {
    addEdu.addEventListener("click", function () {
      addRow("edu-rows", '<div class="border rounded p-3 mb-3 edu-row">' +
        '<div class="form-group"><label>Gelar</label><input type="text" name="degree[]" class="form-control"></div>' +
        '<div class="form-group"><label>Institusi</label><input type="text" name="institution[]" class="form-control"></div>' +
        '<div class="form-group"><label>Detail</label><input type="text" name="detail[]" class="form-control"></div>' +
        '<div class="form-group"><label>Deskripsi</label><textarea name="description[]" class="form-control" rows="2"></textarea></div>' +
        '<button type="button" class="btn btn-danger btn-sm btn-remove-row"><i class="fas fa-trash"></i> Hapus</button></div>');
    });
  }

  var addCert = document.getElementById("add-cert");
  if (addCert) {
    addCert.addEventListener("click", function () {
      addRow("cert-rows", '<div class="row cert-row border rounded p-2 mb-2 mx-0">' +
        '<div class="col-md-5"><input type="text" name="cert_title[]" class="form-control" placeholder="Judul"></div>' +
        '<div class="col-md-6"><input type="text" name="cert_issuer[]" class="form-control" placeholder="Penerbit"></div>' +
        '<div class="col-md-1"><button type="button" class="btn btn-danger btn-sm btn-remove-row"><i class="fas fa-trash"></i></button></div></div>');
    });
  }

  var addProject = document.getElementById("add-project");
  if (addProject) {
    addProject.addEventListener("click", function () {
      addRow("project-rows", '<div class="border rounded p-3 mb-3 project-row"><div class="row">' +
        '<div class="col-md-6"><label>Judul</label><input type="text" name="title[]" class="form-control"></div>' +
        '<div class="col-md-3"><label>Kategori</label><input type="text" name="category[]" class="form-control"></div>' +
        '<div class="col-md-3"><label>Badge</label><select name="badge_color[]" class="form-control"><option>badge-primary</option><option>badge-success</option><option>badge-warning</option></select></div>' +
        '<div class="col-12 mt-2"><label>Deskripsi</label><textarea name="project_description[]" class="form-control" rows="2"></textarea></div>' +
        '<div class="col-md-6 mt-2"><label>Repo</label><input type="text" name="repo_url[]" class="form-control" value="#"></div>' +
        '<div class="col-md-6 mt-2"><label>Demo</label><input type="text" name="demo_url[]" class="form-control" value="#"></div>' +
        '<div class="col-12 mt-2"><button type="button" class="btn btn-danger btn-sm btn-remove-row"><i class="fas fa-trash"></i> Hapus</button></div></div></div>');
    });
  }
})();
