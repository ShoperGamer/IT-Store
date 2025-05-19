// ตรวจสอบโหมดปัจจุบันเมื่อโหลดหน้า
        document.addEventListener('DOMContentLoaded', function() {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme');
            updateThemeToggle(currentTheme);
        });
        
        // ฟังก์ชันสลับโหมด
        document.getElementById('themeToggle').addEventListener('click', function() {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            // เปลี่ยนโหมด
            document.documentElement.setAttribute('data-bs-theme', newTheme);
            
            // อัปเดตคุกกี้
            document.cookie = `theme=${newTheme}; path=/; max-age=31536000`; // 1 ปี
            
            // อัปเดตปุ่ม
            updateThemeToggle(newTheme);
        });
        
        // ฟังก์ชันอัปเดตปุ่มสลับโหมด
        function updateThemeToggle(theme) {
            const moonIcon = document.querySelector('.bi-moon-fill');
            const sunIcon = document.querySelector('.bi-sun-fill');
            const themeText = document.getElementById('themeText');
            
            if (theme === 'dark') {
                moonIcon.classList.add('d-none');
                sunIcon.classList.remove('d-none');
                themeText.textContent = 'โหมดกลางคืน';
            } else {
                sunIcon.classList.add('d-none');
                moonIcon.classList.remove('d-none');
                themeText.textContent = 'โหมดกลางวัน';
            }
        }