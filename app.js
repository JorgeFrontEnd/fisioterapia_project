const accordionHeaders = document.querySelectorAll('.accordion-header');

// Add click event listener to each accordion header
accordionHeaders.forEach(header => {
  header.addEventListener('click', () => {
    // Get corresponding accordion panel
    const panel = header.nextElementSibling;

    // Toggle visibility of panel
    panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
  });
});

function closePopup() {
  document.querySelector('.popup').style.display = 'none';
}

// Show the popup
document.querySelector('.popup').style.display = 'flex';
