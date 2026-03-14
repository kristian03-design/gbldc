 document.addEventListener("DOMContentLoaded", function () {
              const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const closeSidebarBtn = document.getElementById('closeSidebarBtn');
        const sidebar = document.getElementById('sidebar');
        const mobileOverlay = document.getElementById('mobileOverlay');

        // Sidebar functionality
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarClose = document.getElementById('sidebarClose');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

         // Mobile menu functionality
        function openSidebar() {
          sidebar.classList.remove('-translate-x-full');
          mobileOverlay.classList.remove('hidden');
          document.body.classList.add('overflow-hidden');
        }

        function closeSidebar() {
          sidebar.classList.add('-translate-x-full');
          mobileOverlay.classList.add('hidden');
          document.body.classList.remove('overflow-hidden');
        }

        mobileMenuBtn?.addEventListener('click', openSidebar);
        closeSidebarBtn?.addEventListener('click', closeSidebar);
        mobileOverlay?.addEventListener('click', closeSidebar);

        // Close sidebar when clicking on navigation links (mobile)
        const navLinks = sidebar?.querySelectorAll('nav a');
        navLinks?.forEach(link => {
          link.addEventListener('click', () => {
            if (window.innerWidth < 1024) {
              closeSidebar();
            }
          });
        });

        // Close sidebar on window resize to desktop
        window.addEventListener('resize', () => {
          if (window.innerWidth >= 1024) {
            closeSidebar();
          }
        });

        // Application ID input: enforce uppercase alphanumeric, max 10 chars
        const loanIdInput = document.getElementById('loan-id');
        if (loanIdInput) {
            loanIdInput.addEventListener('input', function () {
                this.value = this.value.replace(/[^a-zA-Z0-9]/g, '').toUpperCase();
            });
        }

        // Timeline and progress bar update logic
        function updateTimelineAndProgress(isApproved) {
            const approvedMessage = document.getElementById('approvedMessage');
            const timelineStatus = document.getElementById('timelineStatus');
            const step1 = document.getElementById('progressStep1');
            const step2 = document.getElementById('progressStep2');
            const step3 = document.getElementById('progressStep3');
            const bar1 = document.getElementById('progressBar1');
            const bar2 = document.getElementById('progressBar2');

            // Update progress steps
            step1.querySelector('div').classList.add('bg-green-500');
            step1.querySelector('div').classList.remove('bg-gray-300');
            step1.querySelector('span').classList.add('text-green-700');
            step1.querySelector('span').classList.remove('text-gray-500');
            bar1.classList.add('bg-green-500');
            bar1.classList.remove('bg-gray-300');

            step2.querySelector('div').classList.add('bg-green-500');
            step2.querySelector('div').classList.remove('bg-gray-300');
            step2.querySelector('span').classList.add('text-green-700');
            step2.querySelector('span').classList.remove('text-gray-500');

            if (isApproved) {
                step3.querySelector('div').classList.add('bg-green-500');
                step3.querySelector('div').classList.remove('bg-gray-300');
                step3.querySelector('span').classList.add('text-green-700');
                step3.querySelector('span').classList.remove('text-gray-500');
                step3.querySelector('span').textContent = 'Approved';
                bar2.classList.add('bg-green-500');
                bar2.classList.remove('bg-gray-300');
            } else {
                step3.querySelector('div').classList.remove('bg-green-500');
                step3.querySelector('div').classList.add('bg-gray-300');
                step3.querySelector('span').classList.remove('text-green-700');
                step3.querySelector('span').classList.add('text-gray-500');
                step3.querySelector('span').textContent = 'Decision';
                bar2.classList.remove('bg-green-500');
                bar2.classList.add('bg-gray-300');
            }

            // Update timeline status
            if (timelineStatus) {
                const statusSpan = timelineStatus.querySelector('span');
                const statusH4 = timelineStatus.querySelector('h4');
                const statusP = timelineStatus.querySelector('p');
                const statusIcon = statusSpan.querySelector('i');
                
                if (isApproved) {
                    approvedMessage.classList.remove('hidden');
                    statusSpan.classList.remove('bg-gray-300');
                    statusSpan.classList.add('bg-green-500');
                    statusH4.textContent = 'Approved';
                    statusH4.classList.remove('text-gray-700');
                    statusH4.classList.add('text-green-700');
                    statusP.textContent = 'Your loan application has been approved! Congratulations!';
                    statusIcon.classList.remove('fa-clock');
                    statusIcon.classList.add('fa-check');
                } else {
                    approvedMessage.classList.add('hidden');
                    statusSpan.classList.remove('bg-green-500');
                    statusSpan.classList.add('bg-gray-300');
                    statusH4.textContent = 'Pending Decision';
                    statusH4.classList.remove('text-green-700');
                    statusH4.classList.add('text-gray-700');
                    statusP.textContent = 'You will be notified once a decision is made on your application.';
                    statusIcon.classList.remove('fa-check');
                    statusIcon.classList.add('fa-clock');
                }
            }
        }

        // Loan status form submission
        const loanStatusForm = document.getElementById('loanStatusForm');
        const statusTimeline = document.getElementById('statusTimeline');
        const loanStatusContainer = document.getElementById('loanStatusContainer');

        if (loanStatusForm) {
            loanStatusForm.addEventListener('submit', function (e) {
                e.preventDefault();
                
                const loanId = loanIdInput.value.trim();
                const email = document.getElementById('email').value.trim();
                
                if (loanId && email) {
                    // Show timeline and hide form
                    if (statusTimeline) {
                        statusTimeline.classList.remove('hidden');
                        setTimeout(() => {
                            statusTimeline.classList.add('show');
                        }, 50);
                    }
                    if (loanStatusContainer) {
                        loanStatusContainer.classList.add('hidden');
                    }
                    
                    // Determine status based on loan ID
                    const isApproved = loanId.toUpperCase().endsWith('A');
                    updateTimelineAndProgress(isApproved);
                    
                    // Show SweetAlert
                    if (isApproved) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Loan Status',
                            iconColor: '#16a34a',
                            color: '#1e2939',
                            text: `Status for Application ID "${loanId}": Approved.`,
                            confirmButtonColor: '#16a34a',
                            confirmButtonText: 'Continue'
                        });
                    } else {
                        Swal.fire({
                            icon: 'info',
                            title: 'Loan Status',
                            iconColor: '#ef4444',
                            color: '#1e2939',
                            text: `Status for Application ID "${loanId}": Pending Review.`,
                            confirmButtonColor: '#16a34a',
                            confirmButtonText: 'Continue'
                        });
                    }
                } else {
                    Swal.fire({
                        icon: 'warning',
                        iconColor: '#ef4444',
                        color: '#1e2939',
                        title: 'Missing Information',
                        text: 'Please fill in all required fields.',
                        confirmButtonColor: '#16a34a'
                    });
                }
            });
        }

        // Handle escape key to close sidebar
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSidebar();
            }
            });
        });