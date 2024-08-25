@extends('layouts.app')

@section('content')

<!-- Form goes here -->
<div class="container mt-5">
    <form>
        <div class="form-group">
            <div class="form-control">
                <select id="region" name="region">
                    <option value="">City</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->region }}">{{ $city->region }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-control">
                <select id="town" name="town">
                    <option value="">Town</option>
                </select>
            </div>
            <div class="form-control">
                <select id="quartierSelect" name="quartierSelect">
                    <option value="">Neighborhood</option>
                </select>
            </div>
            <button type="button" id="searchButton">Search</button>  
        </div>
    </form>
    <div id="selected-options-container">
        <div id="selected-city" class="selected-column"></div>
        <div id="selected-town" class="selected-column"></div>
        <div id="selected-neighborhood" class="selected-column"></div>
    </div>
</div>

<!-- Stats goes here -->
<div id="statistics-table" class="hidden">
    <div class="statistics-table">
        <!-- First row -->
        <div class="statistics-row">
            <!-- First column -->
            <div class="statistics-column" >
                <div class="statistics-sub-column-empty"></div>
                <div class="statistics-sub-column" id="total-patients"></div>
                <div class="statistics-sub-column-empty"></div>
            </div>
            <!-- Second column -->
            <div class="statistics-card-flex" id="blood-pressure"></div>
            <!-- Third column -->
            <div class="statistics-row">
                <div class="statistics-column-arrow" id="bp-details">
                    <!-- First row -->
                    <div class="statistics-sub-column-arrow">
                        <div class="arrow-column">
                            <svg fill="#dedadb" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/>
                            </svg>
                        </div>
                    </div>
                    <!-- Second row -->
                    <div class="statistics-sub-column">
                        <p id="bp-normal"></p>
                        <p id="bp-high"></p>
                        <p id="bp-very-high"></p>
                    </div>
                    <!-- Third row -->
                    <div class="statistics-sub-column-empty"></div>
                </div>
            </div> 
        </div>
        <!-- Second row -->
        <div class="statistics-row">
            <div class="statistics-column">
                <div class="statistics-sub-column">
                    <p id="adult-men"></p>
                </div>
                <div class="statistics-sub-column">
                    <p id="children"></p>
                </div>
                <div class="statistics-sub-column">
                    <p id="adult-women"></p>
                </div>
            </div>
            <div class="statistics-sub-column-empty"></div>
            <div class="statistics-sub-column-empty"></div>
        </div>
        <!-- Third row empty wierd isn't it? -->
        <div class="statistics-row">
            <div class="statistics-column">
                <div class="statistics-sub-column-empty"></div>
                <div class="statistics-sub-column-empty"></div>
                <div class="statistics-sub-column-arrow-down">
                    <div class="arrow-column-down">
                        <svg class="centered-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="#dedadb">
                            <path d="M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="statistics-sub-column-empty"></div>
            <div class="statistics-sub-column-empty"></div>
        </div>
        <!-- Fourth row -->
        <div class="statistics-row">
            <div class="statistics-column" >
                <div class="statistics-sub-column-empty"></div>
                <div class="statistics-sub-column-empty"></div>
                <div class="statistics-column">
                    <div class="statistics-sub-column-empty"></div>
                    <div class="statistics-sub-column-pregnant" id="pregnant-women"></div>
                </div>
            </div>
            <div class="statistics-card-flex" id="sugar-check"></div>
            <div class="statistics-row">
                <div class="statistics-column-arrow" id="sugar-details">
                    <div class="statistics-sub-column-arrow">
                        <div class="arrow-column">
                            <svg fill="#dedadb" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="statistics-sub-column">
                        <p id="sugar-normal"></p>
                        <p id="sugar-high"></p>
                        <p id="sugar-very-high"></p>
                    </div>
                    <div class="statistics-sub-column-empty"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal goes here -->
<div id="errorModal" class="modal">
    <div class="modal-content">
      <span class="close-button">&times;</span>
      <p>Please select a city and town, or neighborhood to start.</p>
    </div>
</div>

<script>
    document.getElementById('region').addEventListener('change', function() {
        var region = this.value;
        var townSelect = document.getElementById('town');
        var cityColumn = document.getElementById('selected-city');
        if (region) {
            fetch(`/locations/${region}`)
                .then(response => response.json())
                .then(data => {
                    townSelect.innerHTML = '<option value="">Town</option>';
                    data.forEach(town => {
                        var option = document.createElement('option');
                        option.value = town.prefectures; 
                        option.textContent = town.prefectures;
                        townSelect.appendChild(option);
                    });
                    cityColumn.innerHTML = `<div class="selected-item"><p>${region}</p><span class="remove">x</span></div>`;
                    cityColumn.style.display = 'flex';
                })
                .catch(error => console.error('Error:', error));
        } else {
            townSelect.innerHTML = '<option value="">Town</option>';
            cityColumn.style.display = 'none';
            document.getElementById('selected-neighborhood').style.display = 'none';
        }
    });

    document.getElementById('town').addEventListener('change', function() {
        const town = this.value;
        var neighborhoodSelect = document.getElementById('quartierSelect');
        var townColumn = document.getElementById('selected-town');
        if (town) {
            fetch(`/location/quartiers/${encodeURIComponent(town)}`)
                .then(response => response.json())
                .then(data => {
                    const quartierSelect = document.getElementById('quartierSelect');
                    quartierSelect.innerHTML = '<option value="">Neighborhood</option>';
                    data.forEach(quartier => {
                        const option = document.createElement('option');
                        option.value = quartier.quartier;
                        option.textContent = quartier.quartier;
                        quartierSelect.appendChild(option);
                    });
                    townColumn.innerHTML = `<div class="selected-item"><p>${town}</p><span class="remove">x</span></div>`;
                    townColumn.style.display = 'flex';
                });
        } else {
            neighborhoodSelect.innerHTML = '<option value="">Neighborhood</option>';
            townColumn.style.display = 'none';
            document.getElementById('selected-neighborhood').style.display = 'none';
        }
    });

    document.getElementById('quartierSelect').addEventListener('change', function() {
        var neighborhood = this.value;
        var neighborhoodColumn = document.getElementById('selected-neighborhood');
        
        if (neighborhood) {
            neighborhoodColumn.innerHTML = `<div class="selected-item"><p>${neighborhood}</p><span class="remove">x</span></div>`;
            neighborhoodColumn.style.display = 'flex';
        } else {
            neighborhoodColumn.style.display = 'none';
        }
    });

    document.getElementById('searchButton').addEventListener('click', function() {
        const town = document.getElementById('town').value;
        const quartier = document.getElementById('quartierSelect').value;
        if(town || quartier) {
            fetch(`/statistics?town=${town}&quartier=${quartier}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('statistics-table').classList.remove('hidden');
                    document.getElementById('total-patients').textContent = `Total Patients: ${data.total_patients === null ? '0' : data.total_patients}`;
                    document.getElementById('adult-men').textContent = `Adult Men: ${data.total_adult_men === null ? '0' : data.total_adult_men}`;
                    document.getElementById('children').textContent = `Children: ${data.total_children === null ? '0' : data.total_children}`;
                    document.getElementById('adult-women').textContent = `Adult Women: ${data.total_adult_women === null ? '0' : data.total_adult_women}`;
                    document.getElementById('pregnant-women').textContent = `Pregnant: ${data.total_pregnant_women === null ? '0' : data.total_pregnant_women}`;
                    document.getElementById('blood-pressure').textContent = `Total screended for Blood Pressure: ${data.total_bp_measurements === null ? '0' : data.total_bp_measurements}`;
                    document.getElementById('sugar-check').textContent = `Total screended for Blood Sugar: ${data.total_glucose_measurements === null ? '0' : data.total_glucose_measurements}`;
                    
                    document.getElementById('bp-normal').textContent = `Normal: ${data.bp_normal === null ? '0' : data.bp_normal}`;
                    document.getElementById('bp-high').textContent = `High: ${data.bp_high === null ? '0' : data.bp_high}`;
                    document.getElementById('bp-very-high').textContent = `Very High: ${data.bp_very_high === null ? '0' : data.bp_very_high}`;

                    document.getElementById('sugar-normal').textContent = `Normal: ${data.glucose_normal === null ? '0' : data.glucose_normal}`;
                    document.getElementById('sugar-high').textContent = `High: ${data.glucose_high === null ? '0' : data.glucose_high}`;
                    document.getElementById('sugar-very-high').textContent = `Very High: ${data.glucose_very_high === null ? '0' : data.glucose_very_high}`;
            });
        } else {
            const modal = document.getElementById('errorModal');
            const closeButton = document.querySelector('.close-button');

            modal.style.display = 'block';

            closeButton.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        }
    });

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove')) {
            var column = event.target.closest('.selected-column');
            column.style.display = 'none';
            document.getElementById('statistics-table').classList.add('hidden');
            if (column.id === 'selected-city') {
                document.getElementById('region').value = '';
                document.getElementById('town').innerHTML = '<option value="">Town</option>';
                document.getElementById('selected-town').style.display = 'none';
                document.getElementById('selected-neighborhood').style.display = 'none';
            } else if (column.id === 'selected-town') {
                document.getElementById('town').value = '';
                document.getElementById('quartierSelect').innerHTML = '<option value="">Neighborhood</option>';
                document.getElementById('selected-neighborhood').style.display = 'none';
            } else if (column.id === 'selected-neighborhood') {
                document.getElementById('quartierSelect').value = '';
            }
        }
    });
</script>
@endsection