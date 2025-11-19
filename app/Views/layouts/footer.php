      </div>
      </div>
      </div>

      <footer class="bg-white border-t mt-8">
        <div class="max-w-7xl mx-auto px-6 py-4 text-sm text-gray-500">
          © <?= date('Y') ?> Misbahuddin Julvikar
        </div>
      </footer>

      <!-- SweetAlert -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <!-- Global scripts: delete confirm, sidebar toggle, mobile sidebar, profile dropdown, master collapse -->
      <script>
        (function() {
          // ========= Delete confirmation (data-delete attribute) =========
          document.addEventListener('click', function(e) {
            const el = e.target.closest('[data-delete]');
            if (!el) return;
            e.preventDefault();
            const href = el.getAttribute('href');
            Swal.fire({
              title: 'Konfirmasi Hapus',
              text: "Data akan dihapus. Lanjutkan?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#ef4444',
              confirmButtonText: 'Hapus',
              cancelButtonText: 'Batal'
            }).then((result) => {
              if (result.isConfirmed) window.location = href;
            });
          });

          // ========= Sidebar toggles =========
          const sidebarToggle = document.getElementById('sidebarToggle'); // button in header
          const mobileSidebar = document.getElementById('mobileSidebar'); // mobile slide-in
          const mobileBackdrop = document.getElementById('mobileBackdrop');
          const mobileClose = document.getElementById('mobileClose');
          const sidebar = document.getElementById('sidebar'); // desktop sidebar

          if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
              // If mobile sidebar exists, open it (mobile flow)
              if (mobileSidebar) {
                mobileSidebar.classList.remove('hidden');
              } else if (sidebar) {
                // fallback: toggle desktop sidebar visibility (for very small screens)
                sidebar.classList.toggle('hidden');
              }
            });
          }

          if (mobileBackdrop) {
            mobileBackdrop.addEventListener('click', () => {
              mobileSidebar && mobileSidebar.classList.add('hidden');
            });
          }
          if (mobileClose) {
            mobileClose.addEventListener('click', () => {
              mobileSidebar && mobileSidebar.classList.add('hidden');
            });
          }

          // Also support simple desktop toggle (if you used previous quick toggle)
          // -- keep safe: only toggle visibility if element exists
          const desktopToggleSimple = document.querySelectorAll('[data-toggle-simple-sidebar]');
          desktopToggleSimple.forEach(btn => {
            btn.addEventListener('click', () => {
              if (sidebar) sidebar.classList.toggle('hidden');
            });
          });

          // ========= Profile dropdown =========
          const profileBtn = document.getElementById('profileBtn');
          const profileMenu = document.getElementById('profileMenu');
          document.addEventListener('click', (e) => {
            if (!profileBtn) return;
            if (profileBtn.contains(e.target)) {
              profileMenu.classList.toggle('hidden');
            } else if (profileMenu && !profileMenu.contains(e.target)) {
              profileMenu.classList.add('hidden');
            }
          });

          // ========= Master collapse (sidebar) =========
          const masterToggle = document.getElementById('masterToggleSidebar');
          const masterMenu = document.getElementById('masterMenuSidebar');
          const masterChevron = document.getElementById('masterChevronSidebar');

          if (masterToggle) {
            masterToggle.addEventListener('click', () => {
              if (!masterMenu) return;
              masterMenu.classList.toggle('hidden');
              if (masterChevron) masterChevron.classList.toggle('rotate-90');
              masterToggle.setAttribute('aria-expanded', masterMenu.classList.contains('hidden') ? 'false' : 'true');
            });
          }

          // ========= Optional: small convenience for elements added dynamically =========
          // Re-run bindings for newly added elements (if you dynamically inject)
          window.__rebindMasterMenu = function() {
            // re-query elements and re-attach if needed
          };

        })();
      </script>

      </body>

      </html>