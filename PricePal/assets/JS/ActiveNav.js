const currentLocation = location.href;
const menuItem = document.querySelectorAll('nav div ul li a');
const menuLength = menuItem.length;
for (i = 0; i<menuLength; i++) {
    if (menuItem[i].href === currentLocation) {
        menuItem[i].parentNode.classList.add('active');
        console.log(link);
    }
}