const video = document.getElementById('videoElm');
const registerButton = document.getElementById('registerBtn');
const registerForm = document.getElementById('registerForm');
const container = document.getElementById('container');
const displayFace = document.getElementById('displayFace');

let faceDescriptor;
let username;
let password;

// Load Face API Models
const loadFaceAPI = async () => {
    await faceapi.nets.faceLandmark68Net.loadFromUri('./models');
    await faceapi.nets.faceRecognitionNet.loadFromUri('./models');
    await faceapi.nets.tinyFaceDetector.loadFromUri('./models');
};

function getCameraStream() {
    if (navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: {} })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => console.error("Error accessing camera: ", err));
    }
}

video.addEventListener('playing', () => {
    const canvas = faceapi.createCanvasFromMedia(video);
    document.body.append(canvas);
    const displaySize = {
        width: video.videoWidth,
        height: video.videoHeight
    };
    setInterval(async () => {
        const detections = await faceapi.detectSingleFace(video, new faceapi.TinyFaceDetectorOptions()).withFaceLandmarks().withFaceDescriptor();
        if (detections) {
            faceDescriptor = detections.descriptor; // Save descriptor for registration
            const resizedDetections = faceapi.resizeResults(detections, displaySize);
            canvas.getContext('2d').clearRect(0, 0, displaySize.width, displaySize.height);
            faceapi.draw.drawDetections(canvas, resizedDetections);
        }
    }, 300);
});

// Check if username exists
async function checkUsernameAvailability(username) {
    try {
        const response = await fetch('checkUser.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ name: username })
        });
        const result = await response.json();
        return result;
    } catch (error) {
        console.error("Error checking username:", error);
        return { success: false, message: "Error checking username" };
    }
}

// Handle form submission to proceed to face detection
registerForm.addEventListener('submit', async (event) => {
    event.preventDefault();
    username = document.getElementById('username').value.trim();
    password = document.getElementById('password').value.trim();

    if (!username || !password) {
        alert('Please enter both username and password.');
        return;
    }

    // Check username availability
    const checkResult = await checkUsernameAvailability(username);
    if (!checkResult.success) {
        alert(checkResult.message);
        return;
    }

    // Hide the form and show the face detection section
    container.classList.add('hidden');
    displayFace.style.display = 'block';
    getCameraStream();
});

// Handle face registration
registerButton.addEventListener('click', async () => {
    if (!faceDescriptor) {
        alert("No face detected! Please ensure your face is visible to the camera.");
        return;
    }

    const data = {
        name: username,
        password: password,
        descriptor: Array.from(faceDescriptor)
    };

    try {
        const response = await fetch('register.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });
        const result = await response.json();
        alert(result.message);

        if (result.success) {
            window.location.href = "login.html"; // Redirect to login page
        }
    } catch (error) {
        console.error("Error registering user:", error);
        alert("An error occurred during registration.");
    }
});

loadFaceAPI();
