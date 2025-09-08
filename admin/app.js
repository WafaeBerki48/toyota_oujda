const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});




// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})







const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})





if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})



const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
	if(this.checked) {
		document.body.classList.add('dark');
	} else {
		document.body.classList.remove('dark');
	}
})



// start partie cercle stars 
document.addEventListener("DOMContentLoaded", function () {
    const canvas = document.getElementById("starChart");

    // Lire les valeurs dynamiques à partir de data attributes
    const star5 = parseInt(canvas.dataset.star5) || 0;
    const star4 = parseInt(canvas.dataset.star4) || 0;
    const star3 = parseInt(canvas.dataset.star3) || 0;
    const star2 = parseInt(canvas.dataset.star2) || 0;
    const star1 = parseInt(canvas.dataset.star1) || 0;

    const data = {
        labels: ['5 étoiles', '4 étoiles', '3 étoiles', '2 étoiles', '1 étoile'],
        datasets: [{
            label: 'Répartition des étoiles',
            data: [star5, star4, star3, star2, star1],
        backgroundColor: [
            '#4e79a7', // Bleu moyen
            '#f28e2b', // Orange doux
            '#ad1f1f', // Rouge rosé
            '#76b7b2', // Bleu-vert
            '#59a14f'  // Vert frais
        ],
            hoverOffset: 10
        }]
    };

    new Chart(canvas, {
        type: 'doughnut',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: { size: 12 }
                    }
                },
                title: {
                    display: false
                }
            }
        }
    });
});
// end partie cercle stars 






// start partie supp 
let deleteButtons = document.querySelectorAll('.btn-action.delete');
let modal = document.getElementById('confirmModal');
let confirmBtn = document.getElementById('confirmDeleteBtn');
let cancelBtn = document.getElementById('cancelDeleteBtn');

let selectedId = null;

deleteButtons.forEach(btn => {
btn.addEventListener('click', function () {
    selectedId = this.getAttribute('data-id');
    modal.style.display = 'block';
});
});

confirmBtn.onclick = function () {
if (selectedId) {
    window.location.href = `delete_message.php?id=${selectedId}`;
}
};

cancelBtn.onclick = function () {
modal.style.display = 'none';
selectedId = null;
};

window.onclick = function (event) {
if (event.target == modal) {
    modal.style.display = 'none';
    selectedId = null;
}
};
if (cancelBtn) {
    cancelBtn.onclick = function () {
        modal.style.display = 'none';
        selectedId = null;
    };
}

// end partie supp 




confirmBtn.onclick = function () {
    if (selectedId) {
        window.location.href = `delete_testimonial.php?id=${selectedId}`;
    }
};







