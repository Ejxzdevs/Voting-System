document.addEventListener("DOMContentLoaded", function () {
    const viewLinks = document.querySelectorAll(".view-votes");
    const modal = document.getElementById("voteModal");
    const voteList = document.getElementById("voteList");
    const closeModal = document.getElementById("closeModal");

    viewLinks.forEach(link => {
        link.addEventListener("click", function () {
            const votesData = JSON.parse(this.getAttribute("data-votes"));
            voteList.innerHTML = "";

            if (votesData.length > 0) {
                votesData.forEach(vote => {
                    const listItem = document.createElement("li");
                    listItem.classList.add("px-4", "py-3", "bg-white", "rounded-md", "shadow-sm", "flex", "items-center", "justify-between"); // Added justify-between

                    listItem.innerHTML = `
                        <div class="flex items-center space-x-4">
                            <img src="${vote.image}" alt="${vote.candidate_name}" class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <span class='font-medium text-gray-700 block'>${vote.candidate_name}</span>
                                <span class='font-medium text-gray-500 block text-sm'>${vote.position_name}</span>
                            </div>
                        </div>
                        <div class="text-gray-600">
                            ${vote.vote_id ? 'Vote ID: ' + vote.vote_id : ''}
                        </div>
                    `;
                    voteList.appendChild(listItem);
                });
            } else {
                voteList.innerHTML = "<li class='text-red-500 text-center p-2'>No votes found.</li>";
            }

            modal.classList.remove("hidden");
        });
    });

    closeModal.addEventListener("click", function () {
        modal.classList.add("hidden");
    });

    modal.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.classList.add("hidden");
        }
    });
});