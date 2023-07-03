    // Get the modal element and image element
    const modal = document.getElementById('myModal');
    const modalImage = document.getElementById('modalImage');

    // Get the <span> element that closes the modal
    const span = document.getElementsByClassName('close')[0];

    // Function to open the modal
    function openModal() {
      modal.style.display = 'flex';
    }

    // Function to close the modal
    function closeModal() {
      modal.style.display = 'none';
    }

    // Event listener to open the modal when the image is clicked
    document.getElementById('myImg').addEventListener('click', function() {
      modalImage.src = this.src;
      openModal();
    });

    // Event listener to close the modal when the close button is clicked
    span.addEventListener('click', closeModal);

    // Event listener to close the modal when the Escape key is pressed
    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') {
        closeModal();
      }
    });