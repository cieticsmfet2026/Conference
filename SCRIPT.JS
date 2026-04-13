function openTab(tabName) {

    let tabs = document.getElementsByClassName("tab");

    // Hide all tabs
    for (let i = 0; i < tabs.length; i++) {
        tabs[i].style.display = "none";
    }

    // Check if element exists
    let selectedTab = document.getElementById(tabName);

    if (selectedTab) {
        selectedTab.style.display = "block";
    } else {
        console.error("Tab not found:", tabName);
    }
}

// default load
window.onload = function () {
    openTab('home');
};