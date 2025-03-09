document.addEventListener('DOMContentLoaded', function() {

    let updateBtn = document.getElementById('update');
    let insertBtn = document.getElementById('insert');

    document.querySelectorAll('.edit-link').forEach(link => {

        link.addEventListener('click', function(event) {

        updateBtn.disabled = false;
        updateBtn.classList.remove('cursor-not-allowed');
        updateBtn.classList.remove('bg-gray-500');
        updateBtn.classList.remove('hover:bg-gray-700');
        updateBtn.classList.add('bg-blue-500');
        updateBtn.classList.add('hover:bg-blue-700');
        updateBtn.classList.add('cursor-pointer');

        insertBtn.disabled = true;
        insertBtn.classList.add('cursor-not-allowed')
        insertBtn.classList.add('bg-gray-500');
        insertBtn.classList.add('hover:bg-gray-700');
        insertBtn.classList.remove('cursor-pointer');
        insertBtn.classList.remove('bg-green-500');
        insertBtn.classList.remove('hover:bg-green-700');
    
        
        const data = event.currentTarget.getAttribute('data');
        if (data) {
            try {
              const getData = JSON.parse(data);
              console.log(getData);
              document.getElementById('candidate_name').value = getData.Name;
              document.getElementById('candidate_id').value = getData.id;
              document.getElementById('position').value = getData.Position;

              
        }catch(e){
              console.error('Error parsing JSON:', e);
          }
      } else {
          console.error('No data attribute found');
      }
        });
    });
})