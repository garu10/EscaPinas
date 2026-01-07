function updateDestinations() {
    const regionSelect = document.getElementById('regionSelect');
    const attractionSelect = document.getElementById('attractionSelect');
    if (!regionSelect || !attractionSelect) return;

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

function handleSearch() {
    const regionEl = document.getElementById('regionSelect');
    const destEl = document.getElementById('attractionSelect');
    const resultWrapper = document.getElementById('searchResultWrapper');
    const searchCards = document.querySelectorAll('.search-result-card');

    if (!regionEl || !regionEl.value || regionEl.value === "Select Region") {
        alert("Please select a region first!");
        return;
    }

    const selectedRegion = regionEl.value.toLowerCase();
    const selectedDest = destEl.value ? destEl.value.toLowerCase() : "";
    let count = 0;

    searchCards.forEach(card => {
        const cardIsland = card.getAttribute('data-island').toLowerCase();
        const cardDest = card.getAttribute('data-destination').toLowerCase();

        const matchesRegion = (cardIsland === selectedRegion);
        const matchesDest = (selectedDest === "" || selectedDest === "all destinations" || cardDest === selectedDest);

        if (matchesRegion && matchesDest) {
            card.style.display = "block";
            count++;
        } else {
            card.style.display = "none";
        }
    });

    if (count > 0) {
        resultWrapper.style.display = "block";
        resultWrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
    } else {
        alert("No tours found matching your search.");
        resultWrapper.style.display = "none";
    }
}

function handleQuickSearch() {
    const query = document.getElementById('packageQuickSearch').value.toLowerCase().trim();
    const cards = document.querySelectorAll('.tour-card-item');
    const buttons = document.querySelectorAll('.filter-btn');
    const noResults = document.getElementById('noResultsMessage'); // The new element
    
    let visibleCount = 0;
    let matchedIsland = "";

    cards.forEach(card => {
        const destination = card.getAttribute('data-destination').toLowerCase();
        const tourName = card.querySelector('h5').innerText.toLowerCase();

        if (destination.includes(query) || tourName.includes(query)) {
            card.style.display = "block";
            visibleCount++;
            
            if (!matchedIsland && query !== "") {
                matchedIsland = card.getAttribute('data-island').toLowerCase();
            }
        } else {
            card.style.display = "none";
        }
    });

    if (visibleCount === 0) {
        noResults.style.display = "block";
    } else {
        noResults.style.display = "none";
    }

    buttons.forEach(btn => btn.classList.replace('btn-success', 'btn-outline-success'));

    if (query === "") {
        const allBtn = document.getElementById('btn-all');
        if (allBtn) allBtn.classList.replace('btn-outline-success', 'btn-success');
    } else if (matchedIsland) {
        const targetBtn = document.getElementById('btn-' + matchedIsland);
        if (targetBtn) targetBtn.classList.replace('btn-outline-success', 'btn-success');
    }
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
