function toggleDropdown(event) {
    event.preventDefault();
    const dropdown = document.getElementById('dropdown-menu');
    const otherDropdown = document.getElementById('dropdown-menu-products');

    if (!dropdown.classList.contains('hidden')) {
        dropdown.classList.add('hidden');
        document.removeEventListener('click', handleOutsideDropdownClick);
    } else {
        dropdown.classList.remove('hidden');
        otherDropdown.classList.add('hidden');
        setTimeout(() => {
            document.addEventListener('click', handleOutsideDropdownClick);
        }, 0);
    }
}

function handleOutsideDropdownClick(e) {
    const dropdowns = [
        document.getElementById('dropdown-menu'),
        document.getElementById('dropdown-menu-products')
    ];
    const trigger = document.getElementById('dropdown-trigger'); // Make sure your dropdown button has this id
    let clickedInsideDropdown = false;

    for (const dropdown of dropdowns) {
        if (
            dropdown &&
            !dropdown.classList.contains('hidden') &&
            dropdown.contains(e.target)
        ) {
            clickedInsideDropdown = true;
            break;
        }
    }

    if (
        !clickedInsideDropdown &&
        (!trigger || !trigger.contains(e.target))
    ) {
        for (const dropdown of dropdowns) {
            if (dropdown && !dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
            }
        }
        document.removeEventListener('click', handleOutsideDropdownClick);
    }
}

function toggleDropdownProducts(event) {
    event.preventDefault();
    const dropdown = document.getElementById('dropdown-menu-products');
    const otherDropdown = document.getElementById('dropdown-menu');

    if (!dropdown.classList.contains('hidden')) {
        dropdown.classList.add('hidden');
        document.removeEventListener('click', handleOutsideDropdownClick);
    } else {
        dropdown.classList.remove('hidden');
        otherDropdown.classList.add('hidden');
        setTimeout(() => {
            document.addEventListener('click', handleOutsideDropdownClick);
        }, 0);
    }
}
 function toggleMobileMenu() {
          const menu = document.getElementById('mobile-menu');
          menu.classList.toggle('hidden');
        }
        function toggleDropdownProductsMobile(event) {
          event.preventDefault();
          document.getElementById('dropdown-menu-products-mobile').classList.toggle('hidden');
        }
        function toggleDropdownMobileAbout(event) {
          event.preventDefault();
          document.getElementById('dropdown-menu-about-mobile').classList.toggle('hidden');
        }
