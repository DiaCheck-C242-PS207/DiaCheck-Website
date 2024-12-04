@extends('layouts.main')

@section('content')
    <h2 class="fw-semibold">Predictions</h2>
    <form id="predictionForm">
        <label for="gender">Gender</label>
        <input type="number" id="gender" required><br><br>

        <label for="age">Age</label>
        <input type="number" id="age" required><br><br>

        <label for="hypertension">Hypertension</label>
        <input type="number" id="hypertension" required><br><br>

        <label for="heart_disease">Heart Disease</label>
        <input type="number" id="heart_disease" required><br><br>

        <label for="bmi">BMI</label>
        <input type="number" id="bmi" required><br><br>

        <label for="HbA1c_level">HbA1c Level</label>
        <input type="number" id="HbA1c_level" required><br><br>

        <label for="blood_glucose_level">Blood Glucose Level</label>
        <input type="number" id="blood_glucose_level" required><br><br>

        <button type="submit">Prediksi</button>
    </form>

    <h2 id="result"></h2>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest"></script>

    <script>
        let model;
        let scaler = {};
    
        async function loadModel() {
            try {
                // Memuat model dari JSON
                model = await tf.loadLayersModel('assets/js/tfjs/model.json');
                console.log('Model loaded successfully');
    
                // Tambahkan L2 regularizer pada setiap lapisan Dense
                model.layers.forEach((layer, index) => {
                    if (layer.getClassName() === 'Dense') {
                        console.log(`Adding L2 regularizer to layer ${index}: ${layer.name}`);
                        const units = layer.units; // Ambil jumlah unit
                        const activation = layer.activation; // Ambil fungsi aktivasi
                        const useBias = layer.useBias; // Ambil apakah menggunakan bias
                        const kernelInitializer = layer.kernelInitializer; // Ambil initializer kernel
                        // const biasInitializer = layer.biasInitializer; // Ambil initializer bias
                        const regularizer = tf.regularizers.l2({ l2: 0.001 }); // Set L2 regularizer
    
                        // Membuat ulang lapisan dengan regularizer
                        const newLayer = tf.layers.dense({
                            units,
                            activation,
                            useBias,
                            kernelInitializer,
                            // biasInitializer,
                            kernelRegularizer: regularizer, // Menambahkan regularizer
                            name: layer.name // Tetap gunakan nama lapisan asli
                        });
    
                        // Ganti lapisan lama dengan lapisan baru
                        model.layers[index] = newLayer;
                    }
                });
    
                console.log('Added L2 regularizer to Dense layers');
    
                // Memuat scaler.json
                const scalerResponse = await fetch('assets/js/tfjs/scaler.json');
                scaler = await scalerResponse.json();
                console.log('Scaler loaded:', scaler);
            } catch (error) {
                console.error('Error loading model or scaler:', error);
            }
        }
    
        // Fungsi untuk menormalisasi input
        function normalizeInput(inputData) {
            if (!Array.isArray(inputData) || !Array.isArray(inputData[0])) {
                throw new Error("Input data harus berupa array 2D.");
            }
    
            const tensorData = tf.tensor2d(inputData);
            if (tensorData.shape[1] !== scaler.mean.length) {
                throw new Error("Input data tidak sesuai dengan dimensi yang diharapkan.");
            }
    
            const meanTensor = tf.tensor(scaler.mean);
            const stdTensor = tf.tensor(scaler.scale);
            return tensorData.sub(meanTensor).div(stdTensor);
        }
    
        // Menjalankan prediksi
        async function makePrediction(event) {
            event.preventDefault();
    
            const gender = parseFloat(document.getElementById('gender').value);
            const age = parseFloat(document.getElementById('age').value);
            const hypertension = parseFloat(document.getElementById('hypertension').value);
            const heart_disease = parseFloat(document.getElementById('heart_disease').value);
            const bmi = parseFloat(document.getElementById('bmi').value);
            const HbA1c_level = parseFloat(document.getElementById('HbA1c_level').value);
            const blood_glucose_level = parseFloat(document.getElementById('blood_glucose_level').value);
    
            const inputData = [
                [gender, age, hypertension, heart_disease, bmi, HbA1c_level, blood_glucose_level]
            ];
    
            if (inputData.some(row => row.some(value => isNaN(value) || !isFinite(value)))) {
                alert("Pastikan semua field terisi dengan angka yang valid.");
                return;
            }
    
            try {
                const normalizedInput = normalizeInput(inputData);
                const predictions = await model.predict(normalizedInput);
                predictions.print();
    
                const predictionValue = predictions.dataSync()[0];
                document.getElementById('result').innerText = `Prediksi hasil: ${predictionValue}`;
            } catch (error) {
                console.error('Error during prediction:', error);
            }
        }
    
        // Memuat model saat halaman dimuat
        window.onload = loadModel;
    
        document.getElementById('predictionForm').addEventListener('submit', makePrediction);
    </script>
@endpush