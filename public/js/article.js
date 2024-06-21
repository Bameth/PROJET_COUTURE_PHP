document.addEventListener('DOMContentLoaded', (event) => {
    let deleteButtons = document.querySelectorAll('.delete-button');
    let deleteModal = document.getElementById('deleteModal');
    let confirmDeleteButton = document.getElementById('confirmDelete');
    let cancelDeleteButton = document.getElementById('cancelDelete');
    let articleIdToDelete = null;

    deleteButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            articleIdToDelete = button.getAttribute('data-id');
            deleteModal.classList.remove('hidden');
        });
    });

    cancelDeleteButton.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
    });

    confirmDeleteButton.addEventListener('click', () => {
        window.location.href = `/?controller=article&action=del-art&id=${articleIdToDelete}`;
    });
});
