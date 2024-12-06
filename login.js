const video = document.getElementById('videoElm');
const loginForm = document.getElementById('loginForm');
const displayFace = document.getElementById('displayFace');
const verifyFaceButton = document.getElementById('verifyFaceBtn');

let faceDescriptor;

// Load Face API models
const loadFaceAPI = async () => {
    await faceapi.nets.faceLandmark68Net.loadFromUri('./models');
    await faceapi.nets.faceRecognitionNet.loadFromUri('./models');
    await faceapi.nets.tinyFaceDetector.loadFromUri('./models');
};

// Access camera stream
function getCameraStream() {
    if (navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: {} })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => console.error("Error accessing camera: ", err));
    }
}

// Handle login form submission
loginForm.addEventListener('submit', async (event) => {
    event.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    try {
        const response = await fetch('login.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ username, password })
        });
        const result = await response.json();

        if (result.success) {
            // Show face detection window if username and password are correct
            container.classList.add('hidden');
            displayFace.style.display = 'block';
            getCameraStream();
        } else {
            alert(result.message);
        }
    } catch (error) {
        console.error("Error during login:", error);
        alert("An error occurred during login.");
    }
});

// Face detection setup
video.addEventListener('playing', () => {
    const canvas = faceapi.createCanvasFromMedia(video);
    document.body.append(canvas);
    const displaySize = { width: video.videoWidth, height: video.videoHeight };
    
    setInterval(async () => {
        const detections = await faceapi.detectSingleFace(video, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceDescriptor();
        if (detections) {
            faceDescriptor = detections.descriptor; // Save face descriptor
            const resizedDetections = faceapi.resizeResults(detections, displaySize);
            canvas.getContext('2d').clearRect(0, 0, displaySize.width, displaySize.height);
            faceapi.draw.drawDetections(canvas, resizedDetections);
        }
    }, 300);
});

// Handle face verification
verifyFaceButton.addEventListener('click', async () => {
    if (!faceDescriptor) {
        alert("No face detected! Please ensure your face is visible to the camera.");
        return;
    }

    try {
        const response = await fetch('verifyFace.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ descriptor: Array.from(faceDescriptor) })
        });
        const result = await response.json();

        if (result.success) {
            alert(result.message);
            window.location.href = "homePage.php"; // Redirect to home page
        } else {
            alert(result.message);
        }
    } catch (error) {
        console.error("Error during face verification:", error);
        alert("An error occurred during face verification.");
    }
});

loadFaceAPI();
