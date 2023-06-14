<?php include "user_detected.php";  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Test</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="Testpage.css" />

    <style>
        #disease_predictor {
            border: 1px solid orange;
            padding: 24px;
            color: white;
            font-size: 20px;
            font-family: auto;
            line-height: 32px;
            font-weight: 700;
            border-radius: 10px;
        }

        #result {
            text-align: center;
            margin-top: 28px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php include_once "nav.php";   ?>
        <div class="row">
            <div class="firstPart" style="height: 950px">
                <!-- <p><input type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;"></p> -->
                <input type="file" style="opacity: 0" id="file-upload" accept="image/*" onchange="previewImage(event);" />
                <p>
                    <label for="file-upload" onclick="init()" class="uploadButton"><i class="fa fa-plus"></i> Upload your image</label>
                </p>

                <div class="displayImage">
                    <p><img id="image-shower" style="width: 100%; height: 300px" ; /></p>
                </div>
                <button style="display: none" class="predictButton">Predict</button>

                <h2 id="result"></h2>

                <div id="disease_predictor"></div>
                <!--<a href="#" class="new">Learn More</a>-->

                <div class="commentSection" style="display: none">
                    <div class="footer-title" style="text-align: center; font-size: 23px; color: white; padding-top: 30px; font-weight: bold">How Would You Rate This Prediction?</div>
                    <ul class="footer-social">
                        <li><a href="#">&#128545;</a></li>
                        <li><a href="#">&#128529;</a></li>
                        <li><a href="#">&#128530;</a></li>
                        <li><a href="#">&#128516;</a></li>
                        <li><a href="#">&#128525;</a></li>
                    </ul>
                    <textarea class="feedback" cols="30" rows="3" placeholder="Write your opinion!"></textarea>
                    <button class="shareButton"><i class="fa fa-share-alt"></i> Share!</button>
                </div>
            </div>
        </div>
    </div>

    <!-- <script>
            // var loadFile = function (event) {
            //     var image = document.getElementById("output");
            //     image.src = URL.createObjectURL(event.target.files[0]);
            // };
        </script> -->

    <!-- <div>Teachable Machine Image Model</div>
    <button type="button" id="webcamButton" onclick="init()">Webcam</button> -->
    <!-- <div id="webcam-container"></div> -->
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>
    <script type="text/javascript">
        let imageSrc; //extra added
        image = new Image(); //extra added
        // More API functions here:
        // https://github.com/googlecreativelab/teachablemachine-community/tree/master/libraries/image

        // the link to your model provided by Teachable Machine export panel
        const UL = "https://teachablemachine.withgoogle.com/models/u7X9xnP_b/"; //here change UL from URL
        // UL = "https://teachablemachine.withgoogle.com/models/u7X9xnP_b/";

        let model, webcam, labelContainer, maxPredictions;

        // Load the image model and setup the webcam
        async function init() {
            // document.getElementById("webcamButton").disabled = true;
            // document.getElementById("image-shower").remove();

            const modelURL = UL + "model.json"; //here change UL from URL
            const metadataURL = UL + "metadata.json"; //here change UL from URL

            // load the model and metadata
            // Refer to tmImage.loadFromFiles() in the API to support files from a file picker
            // or files from your local hard drive
            // Note: the pose library adds "tmImage" object to your window (window.tmImage)
            model = await tmImage.load(modelURL, metadataURL);
            maxPredictions = model.getTotalClasses();

            // Convenience function to setup a webcam
            // const flip = true; // whether to flip the webcam
            // webcam = new tmImage.Webcam(200, 200, flip); // width, height, flip
            // await webcam.setup(); // request access to the webcam
            // await webcam.play();
            window.requestAnimationFrame(loop);

            // append elements to the DOM

            // document.getElementById("webcam-container").appendChild(webcam.canvas);
            labelContainer = document.getElementById("disease_predictor");
            Result = document.getElementById("result");
            for (let i = 0; i < maxPredictions; i++) {
                // and class labels
                labelContainer.appendChild(document.createElement("div"));
            }
        }

        async function loop() {
            // webcam.update(); // update the webcam frame
            await predict();
            window.requestAnimationFrame(loop);
        }

        // run the webcam image through the image model
        async function predict() {
            // predict can take in an image, video or canvas html element
            // const prediction = await model.predict(webcam.canvas);
            const prediction = await model.predict(image);
            result.innerHTML = "Result:";
            for (let i = 0; i < maxPredictions; i++) {
                const classPrediction = prediction[i].className + ": " + 100 * prediction[i].probability.toFixed(2) + "%";
                labelContainer.childNodes[i].innerHTML = classPrediction;
            }
        }
    </script>


    <!-- //Preview an Image Before Uploading Using JavaScript, it was added from here -->
    <script>
        /**
         * Create an arrow function that will be called when an image is selected.
         */
        const previewImage = (event) => {
            /**
             * Get the selected files.
             */
            const imageFiles = event.target.files;
            /**
             * Count the number of files selected.
             */
            const imageFilesLength = imageFiles.length;
            /**
             * If at least one image is selected, then proceed to display the preview.
             */
            if (imageFilesLength > 0) {
                /**
                 * Get the image path.
                 */
                imageSrc = URL.createObjectURL(imageFiles[0]);
                image.src = imageSrc; //it has been added by me

                /**
                 * Select the image preview element.
                 */
                const imagePreviewElement = document.querySelector("#image-shower");
                /**
                 * Assign the path to the image preview element.
                 */
                imagePreviewElement.src = imageSrc;
                /**
                 * Show the element by changing the display value to "block".
                 */
                imagePreviewElement.style.display = "block";
            }

            //    imageUpload();
        };
    </script>

    <script src="script.js"></script>
</body>

</html>