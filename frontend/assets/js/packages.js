//js sa search
function updateDestinations() {
        const regionSelect = document.getElementById('regionSelect');
        const attractionSelect = document.getElementById('attractionSelect');
        const selectedRegion = regionSelect.value;
        const dataEntries = document.querySelectorAll('.dest-item');

        attractionSelect.innerHTML = '<option value="" selected disabled>Select Destination</option>';
        attractionSelect.disabled = false;

        const addedDestinations = new Set();

        dataEntries.forEach(entry => {
            const entryRegion = entry.getAttribute('data-region');
            const entryValue = entry.getAttribute('data-val');

            if (entryRegion === selectedRegion && !addedDestinations.has(entryValue)) {
                addedDestinations.add(entryValue);
                const opt = document.createElement('option');
                opt.value = entryValue;
                opt.textContent = entryValue;
                attractionSelect.appendChild(opt);
            }
        });
    }

    function filterTours(island, btn) {
        document.querySelectorAll('.filter-btn').forEach(b => {
            b.classList.replace('btn-success', 'btn-outline-success');
        });
        btn.classList.replace('btn-outline-success', 'btn-success');

        const cards = document.querySelectorAll('.tour-card-item');
        cards.forEach(card => {
            const cardIsland = card.getAttribute('data-island').toLowerCase();
            card.style.display = (island === 'all' || cardIsland === island.toLowerCase()) ? "block" : "none";
        });
    }

    function filterDiscover(category, btn) {
        document.querySelectorAll('.filter-discover-btn').forEach(b => {
            b.classList.replace('btn-success', 'btn-outline-success');
        });
        btn.classList.replace('btn-outline-success', 'btn-success');

        const items = document.querySelectorAll('.discover-item');
        items.forEach(item => {
            const itemCategory = item.getAttribute('data-category').toLowerCase();
            item.style.display = (category === 'all' || itemCategory === category.toLowerCase()) ? 'block' : 'none';
        });
    }
