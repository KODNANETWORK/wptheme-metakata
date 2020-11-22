if (!Detector.webgl) Detector.addGetWebGLMessage();

var SCREEN_WIDTH = window.innerWidth;
var SCREEN_HEIGHT = window.innerHeight;
var renderer, camera, scene, moverGroup, floorGeometry, floorMaterial, pointLight, pointLight2, pGeometry;
var FLOOR_RES = 60;
var FLOOR_HT = 650;
var stepCount = 0;
var noiseScale = 9.5;
var noiseSeed = Math.random() * 100;
var FLOOR_WIDTH = 3600;
var FLOOR_DEPTH = 4800;
var MOVE_SPD = 1.9;
var mouseX = 0;
var mouseY = 0;
var windowHalfX = window.innerWidth / 2;
var windowHalfY = window.innerHeight / 2;

var snoise = new ImprovedNoise();
var composer, shaderTime = 0,
    filmPass, renderPass, copyPass, glitchPass, effectVignette;
document.addEventListener("mousemove", onDocumentMouseMove, false);

function onDocumentMouseMove(event) {
    mouseX = (event.clientX - (windowHalfX)) * 0.8;
    mouseY = (event.clientY - (windowHalfY)) * 0.8;
}

function params() {
    var bluriness = 5;
    hblur.uniforms["h"].value = bluriness / window.innerWidth;
    vblur.uniforms["v"].value = bluriness / window.innerHeight;
    hblur.uniforms["r"].value = vblur.uniforms["r"].value = 0.5;
    filmPass.uniforms.grayscale.value = 0;
    filmPass.uniforms["sCount"].value = 2;
    filmPass.uniforms["sIntensity"].value = 0.2;
    filmPass.uniforms["nIntensity"].value = 1;
    effectVignette.uniforms["offset"].value = 1.0;
    effectVignette.uniforms["darkness"].value = 1.3;
}

init();
animate();

function init() {
    camera = new THREE.PerspectiveCamera(70, window.innerWidth / window.innerHeight, 1, 4000);
    camera.position.z = 2750;
    scene = new THREE.Scene();
    scene.fog = new THREE.FogExp2(0x1c3c4a, 0.00045);


    var hemisphereLight = new THREE.HemisphereLight(0xe3feff, 0xe6ddc8, 0.7);
    scene.add(hemisphereLight);
    hemisphereLight.position.y = 300;

    pointLight = new THREE.PointLight(0xe07bff, 1.5);
    pointLight.position.z = 0;
    scene.add(pointLight);

    pointLight2 = new THREE.PointLight(0xff4e00, 1.2);
    pointLight2.position.z = 0;
    scene.add(pointLight2);

    var cubeMaterial = new THREE.MeshPhongMaterial({
        color: 0x447080,
        combine: THREE.MixOperation,
        side: THREE.DoubleSide,
        reflectivity: 0.5,
        shading: THREE.FlatShading
    });

    moverGroup = new THREE.Object3D();
    scene.add(moverGroup);
    var floorGroup = new THREE.Object3D();

    var floorMaterial = new THREE.MeshPhongMaterial({
        color: 0xeeeeee, //diffuse
        side: THREE.DoubleSide,
        blending: THREE.AdditiveBlending,
        wireframe: true
    });

    //add extra x width
    floorGeometry = new THREE.PlaneGeometry(FLOOR_WIDTH + 1200, FLOOR_DEPTH, FLOOR_RES, FLOOR_RES);
    var floorMesh = new THREE.Mesh(floorGeometry, cubeMaterial);
    var floorMesh2 = new THREE.Mesh(floorGeometry, floorMaterial);

    floorMesh2.position.y = 20;
    floorMesh2.position.z = 5;
    floorGroup.add(floorMesh);
    floorGroup.add(floorMesh2);
    scene.add(floorGroup);
    floorMesh.rotation.x = Math.PI / 1.65;
    floorMesh2.rotation.x = Math.PI / 1.65;
    floorGroup.position.y = 180;

    //particles
    pGeometry = new THREE.Geometry();
    for (i = 0; i < 2000; i++) {
        var vertex = new THREE.Vector3();
        vertex.x = 4000 * Math.random() - 2000;
        vertex.y = -200 + Math.random() * 700;
        vertex.z = 5000 * Math.random() - 2000;
        pGeometry.vertices.push(vertex);
    }
    material = new THREE.PointsMaterial({
        size: 10,
        transparent: true,
        opacity: 1,
        blending: THREE.AdditiveBlending,
        alphaTest: 0.5
    });

    var particles = new THREE.Points(pGeometry, material);
    particles.sortParticles = true;
    moverGroup.add(particles);

    renderer = new THREE.WebGLRenderer({
        antialias: true
    });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setClearColor(0x1c3c4a);
    renderer.domElement.id = 'canvas';
    document.getElementById('canvas').appendChild(renderer.domElement);

    //POST PROCESSING
    //Create Shader Passes
    renderPass = new THREE.RenderPass(scene, camera);
    hblur = new THREE.ShaderPass(THREE.HorizontalTiltShiftShader);
    vblur = new THREE.ShaderPass(THREE.VerticalTiltShiftShader);
    effectVignette = new THREE.ShaderPass(THREE.VignetteShader);
    copyPass = new THREE.ShaderPass(THREE.CopyShader);
    filmPass = new THREE.ShaderPass(THREE.FilmShader);
    glitchPass = new THREE.GlitchPass();

    composer = new THREE.EffectComposer(renderer);
    composer.addPass(renderPass);
    composer.addPass(hblur);
    composer.addPass(vblur);
    composer.addPass(filmPass);
    composer.addPass(effectVignette);
    composer.addPass(glitchPass);
    composer.addPass(copyPass);
    copyPass.renderToScreen = true;

    params();

    setWaves();
    window.addEventListener("resize", onWindowResize, false);
}

function setWaves() {
    stepCount++;
    moverGroup.position.z = -MOVE_SPD;
    var i;
    var ipos;
    var offset = stepCount * MOVE_SPD / FLOOR_DEPTH * FLOOR_RES;

    for (i = 0; i < FLOOR_RES + 1; i++) {
        for (var j = 0; j < FLOOR_RES + 1; j++) {
            ipos = i + offset;
            if ((i > 30) || (j < 12) || (j > 48)) {
                floorGeometry.vertices[i * (FLOOR_RES + 1) + j].z = snoise.noise(ipos / FLOOR_RES * noiseScale, j / FLOOR_RES * noiseScale, noiseSeed) * FLOOR_HT;
            } else if (i > 25 && i < 30) {
                floorGeometry.vertices[i * (FLOOR_RES + 1) + j].z = snoise.noise(ipos / FLOOR_RES * noiseScale, j / FLOOR_RES * noiseScale, noiseSeed) * (FLOOR_HT / 1.2);
            } else {
                floorGeometry.vertices[i * (FLOOR_RES + 1) + j].z = snoise.noise(ipos / FLOOR_RES * noiseScale, j / FLOOR_RES * noiseScale, noiseSeed) * (FLOOR_HT / 2);
            }
        }
    }
    floorGeometry.verticesNeedUpdate = true;
}

function onWindowResize() {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
    composer.setSize(window.innerWidth, window.innerHeight);
}

function animate() {
    requestAnimationFrame(animate);
    render();
}

function render() {

    var timer = -0.0002 * Date.now();

    pointLight.position.x = 2400 * Math.cos(timer);
    pointLight.position.z = 2400 * Math.sin(timer);

    pointLight2.position.x = 1800 * Math.cos(-timer * 1.5);
    pointLight2.position.z = 1800 * Math.sin(-timer * 1.5);

    camera.position.x += (mouseX - camera.position.x) * .05;
    camera.position.y += (-mouseY - camera.position.y) * .05;
    camera.lookAt(scene.position);

    for (i = 0; i < 2000; i++) {
        pGeometry.vertices[i].z += 0.5;
        if (pGeometry.vertices[i].z > 2700) {
            pGeometry.vertices[i].z = -2000;
        }
    }
    pGeometry.verticesNeedUpdate = true;

    setWaves();
    composer.render(0.1);
}
