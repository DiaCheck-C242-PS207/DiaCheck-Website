<div id="loading-screen" class="bg-color" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 9999;">
    <div class="container d-flex flex-column align-items-center justify-content-center h-100">
        <img src="{{ url('assets/images/diacheck-icon.png') }}" alt="DiaCheck Icon" style="width: 100px; height: auto;">
        <h1 class="fw-bold primary-color">Dia<b class="fw-bold text-color">Check</b></h1>
        <p class="fw-normal text-color text-center mt-2">Application for Checking and Predicting Potential Diabetes Risk</p>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const loadingScreen = document.getElementById('loading-screen');
        if (loadingScreen) {
            setTimeout(() => {
                loadingScreen.style.display = 'none';
            }, 3000);
        }
    });
</script>