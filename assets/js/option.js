function openModal() {
    document.getElementById("modal").classList.remove("hidden");
}

function closeModal() {
    document.getElementById("modal").classList.add("hidden");
}

function openAddPositionModal() {
    document.getElementById("addPositionModal").classList.remove("hidden");
    closeModal();
}

function closeAddPositionModal() {
    document.getElementById("addPositionModal").classList.add("hidden");
    openModal();
}

function openEditPositionModal(positionId, positionName) {
    document.getElementById('edit_position').value = positionName;
    document.getElementById('edit_position_id').value = positionId;
    document.getElementById("editPositionModal").classList.remove("hidden");
    closeModal();
}

function closeEditPositionModal() {
    document.getElementById("editPositionModal").classList.add("hidden");
    openModal();
}
