<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MemeIT - Meme Generator</title>

    <link rel="stylesheet" href=<?php echo ROOT."views/css/style.css"?>>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

</head>

<body>
    <?php require_once VIEWS_DIR."/header.php"; ?>
    
    <main style="background-image: url('<?php echo ROOT."views/images/papyrus.png" ?>'); background-size: auto;">
        <h1 id="topic-title"><?php echo $data[0].", your topic is <span>".$data[1]."</span>" ?></h1>
        <div class="row">
            <section class="meme-preview column">
                <div style="font-family: 'Impact';">
                    <canvas id="meme-canvas" width="600" height="500">
                        Your browser does not support the HTML5 canvas tag.
                    </canvas>
                </div>

                <div class=" row">
                    <div class="column">
                        <a href="#" class="btn btn-download" download="meme.png" onclick="downloadMeme(this)">
                            <i class="fa fa-download" aria-hidden="true"></i>
                            Download
                        </a>
                    </div>

                    <div class="column">
                        <a href="" class="btn btn-download" id="save">
                            <i class="fa fa-save" aria-hidden="true"></i>
                            Save
                        </a>
                    </div>

                    <div class="column">
                        <!-- <a href="<?php echo ROOT."generator/public" ?>" class="btn btn-download">
                            <i class="fa fa-share" aria-hidden="true"></i>
                            Make Public
                        </a> -->
                        <label class="container btn btn-download">
                            <input id="public" type="checkbox" <?php if($data[2]) { echo "checked"; } ?>>
                            Public
                        </label>
                    </div>

                </div>

                <img id="start-image" src="image.jpg" alt="">

            </section>

            <section class="meme-controls column">
                <div class="input-custom-img row">
                    <!-- <div class="column"> -->
                    <span class="input-img-lbl">Image:</span>
                    <input type="file" id="img-input" onchange="loadCustom(this)" />
                    <!-- </div> -->
                    <span id="or">or</span>
                    <!-- <div class="column"> -->
                    <a href="#openModal" class="btn">
                        <i class="fa fa-image" aria-hidden="true"></i>
                        Choose Template</a>
                    <!-- </div> -->

                    <!-- <div class="column"> -->
                    <a id="add-text" class="btn" href="javascript:;" onclick="addTextLine();">
                        <i class="fa fa-plus"></i>
                        Add Line
                    </a>
                    <!-- </div> -->
                </div>

                <!-- GALLERY MODAL -->
                <div id="openModal" class="modalDialog">
                    <div>
                        <a href="#close" id="closeModal" class="close">&times;</a>
                        <h2>Meme Templates</h2>

                        <div class="row">
                            <div class="column">
                                <img src=<?php echo ROOT."views/images/template0.jpg" ?>>
                                <img src=<?php echo ROOT."views/images/template1.jpg" ?>>
                                <img src=<?php echo ROOT."views/images/template2.jpg" ?>>
                                <img src=<?php echo ROOT."views/images/template3.jpg" ?>>
                            </div>
                            <div class="column">
                                <img src=<?php echo ROOT."views/images/template4.jpg" ?>>
                                <img src=<?php echo ROOT."views/images/template5.jpg" ?>>
                                <img src=<?php echo ROOT."views/images/template6.jpg" ?>>
                                <img src=<?php echo ROOT."views/images/template7.jpg" ?>>
                            </div>
                            <div class="column">
                                <img src=<?php echo ROOT."views/images/template8.jpg" ?>>
                                <img src=<?php echo ROOT."views/images/template9.jpg" ?>>
                                <img src=<?php echo ROOT."views/images/template10.jpg" ?>>
                                <img src=<?php echo ROOT."views/images/template11.jpg" ?>>

                            </div>
                            <div class="column">
                                <img src=<?php echo ROOT."views/images/template12.jpg" ?>>
                                <img src=<?php echo ROOT."views/images/template13.jpg" ?>>
                                <img src=<?php echo ROOT."views/images/template14.jpg" ?>>
                                <img src=<?php echo ROOT."views/images/template15.jpg" ?>>
                            </div>
                            <div class="column">
                                <img src=<?php echo ROOT."views/images/template16.jpg" ?>>
                                <img src=<?php echo ROOT."views/images/template17.jpg" ?>>
                                <img src=<?php echo ROOT."views/images/template18.jpg" ?>>
                                <img src=<?php echo ROOT."views/images/template19.jpg" ?>>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END GALLERY MODAL -->

                <div id="editors" class="text-editors">
                    <template id="template">
                        <!-- <div class="text-editor row"> -->
                        <!-- Column-1 -->
                        <div class="column">
                            <div class="row">
                                <label for="text-input">Text:</label>
                                <input type="text" id="text-input" placeholder="Enter your text..." data-property="line"
                                    oninput="editText(this, {index})">
                            </div>
                            <div class="row">
                                <label for="font-size">Font Size:</label>
                                <input type="range" id="font-size" value="40" min="10" step="2" data-property="size"
                                    oninput="editText(this, {index})">
                                <!-- <span id="font-size-value"><strong>100</strong>px</span> -->
                            </div>
                            <div class="row">
                                <label for="font-color">Font Color:</label>
                                <input type="color" id="font-color" value="#ffffff" data-property="color"
                                    oninput="editText(this, {index})">
                            </div>
                            <div class="row">
                                <label for="offset-top">Offset Top:</label>
                                <input type="range" id="offset-top" value="70" min="0" max="700" data-property="y"
                                    oninput="editText(this, {index})">
                                <!-- <span id="offset-top-value"><strong>100</strong>px</span> -->
                            </div>
                        </div>

                        <!-- Column 2 -->
                        <div class="column">
                            <div class="row">
                                <label for="outline">Outline:</label>
                                <input type="checkbox" checked id="outline" data-property="isOutline"
                                    oninput="editText(this, {index})">
                            </div>
                            <div class="row">
                                <label for="outline-width">Width:</label>
                                <input type="range" id="outline-width" value="2" min="0" max="30"
                                    data-property="outlineWidth" oninput="editText(this, {index})">
                            </div>
                            <div class="row">
                                <label for="outline-color">Color:</label>
                                <input type="color" id="outline-color" value="#000000" data-property="strokeStyle"
                                    oninput="editText(this, {index})">
                            </div>
                            <div class="row">
                                <label for="offset-left">Offset Left:</label>
                                <input type="range" id="offset-left" value="150" min="0" max="700" data-property="x"
                                    oninput="editText(this, {index})">
                                <!-- <span id="offset-left-value"><strong>100</strong>px</span> -->
                            </div>
                            <!-- </div> -->
                    </template>
                </div>
        </div>
        </section>
        </div>

    </main>

    <?php require_once VIEWS_DIR."/footer.php"; ?>

    <script src=<?php echo ROOT."views/js/script.js"?>></script>

</body>

</html>