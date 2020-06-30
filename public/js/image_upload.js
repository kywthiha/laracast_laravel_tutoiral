/******/
(function (modules) { // webpackBootstrap
    /******/ 	// The module cache
    /******/
    var installedModules = {};
    /******/
    /******/ 	// The require function
    /******/
    function __webpack_require__(moduleId) {
        /******/
        /******/ 		// Check if module is in cache
        /******/
        if (installedModules[moduleId]) {
            /******/
            return installedModules[moduleId].exports;
            /******/
        }
        /******/ 		// Create a new module (and put it into the cache)
        /******/
        var module = installedModules[moduleId] = {
            /******/            i: moduleId,
            /******/            l: false,
            /******/            exports: {}
            /******/
        };
        /******/
        /******/ 		// Execute the module function
        /******/
        modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
        /******/
        /******/ 		// Flag the module as loaded
        /******/
        module.l = true;
        /******/
        /******/ 		// Return the exports of the module
        /******/
        return module.exports;
        /******/
    }

    /******/
    /******/
    /******/ 	// expose the modules object (__webpack_modules__)
    /******/
    __webpack_require__.m = modules;
    /******/
    /******/ 	// expose the module cache
    /******/
    __webpack_require__.c = installedModules;
    /******/
    /******/ 	// define getter function for harmony exports
    /******/
    __webpack_require__.d = function (exports, name, getter) {
        /******/
        if (!__webpack_require__.o(exports, name)) {
            /******/
            Object.defineProperty(exports, name, {enumerable: true, get: getter});
            /******/
        }
        /******/
    };
    /******/
    /******/ 	// define __esModule on exports
    /******/
    __webpack_require__.r = function (exports) {
        /******/
        if (typeof Symbol !== 'undefined' && Symbol.toStringTag) {
            /******/
            Object.defineProperty(exports, Symbol.toStringTag, {value: 'Module'});
            /******/
        }
        /******/
        Object.defineProperty(exports, '__esModule', {value: true});
        /******/
    };
    /******/
    /******/ 	// create a fake namespace object
    /******/ 	// mode & 1: value is a module id, require it
    /******/ 	// mode & 2: merge all properties of value into the ns
    /******/ 	// mode & 4: return value when already ns object
    /******/ 	// mode & 8|1: behave like require
    /******/
    __webpack_require__.t = function (value, mode) {
        /******/
        if (mode & 1) value = __webpack_require__(value);
        /******/
        if (mode & 8) return value;
        /******/
        if ((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
        /******/
        var ns = Object.create(null);
        /******/
        __webpack_require__.r(ns);
        /******/
        Object.defineProperty(ns, 'default', {enumerable: true, value: value});
        /******/
        if (mode & 2 && typeof value != 'string') for (var key in value) __webpack_require__.d(ns, key, function (key) {
            return value[key];
        }.bind(null, key));
        /******/
        return ns;
        /******/
    };
    /******/
    /******/ 	// getDefaultExport function for compatibility with non-harmony modules
    /******/
    __webpack_require__.n = function (module) {
        /******/
        var getter = module && module.__esModule ?
            /******/            function getDefault() {
                return module['default'];
            } :
            /******/            function getModuleExports() {
                return module;
            };
        /******/
        __webpack_require__.d(getter, 'a', getter);
        /******/
        return getter;
        /******/
    };
    /******/
    /******/ 	// Object.prototype.hasOwnProperty.call
    /******/
    __webpack_require__.o = function (object, property) {
        return Object.prototype.hasOwnProperty.call(object, property);
    };
    /******/
    /******/ 	// __webpack_public_path__
    /******/
    __webpack_require__.p = "/";
    /******/
    /******/
    /******/ 	// Load entry module and return exports
    /******/
    return __webpack_require__(__webpack_require__.s = 2);
    /******/
})
    /************************************************************************/
    /******/ ({

    /***/ "./resources/js/image_upload.js":
    /*!**************************************!*\
      !*** ./resources/js/image_upload.js ***!
      \**************************************/
    /*! no static exports found */
    /***/ (function (module, exports) {

        window.onload = function () {
            var image_upload_button = $("#image_upload");
            var upload_status = $("#upload_status");
            var image_input = $('input[type="hidden"]#article_image');
            var image_preview = $('img#image_preview');
            var choose_image_button = $('input[type="file"]#image');

            var ImageUploadRequest = function ImageUploadRequest(_ref) {
                var url = _ref.url,
                    image = _ref.image;
                var formData = new FormData();
                formData.append('image', image);
                return fetch(url, {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: formData
                });
            };

            var loadingUiStatus = function loadingUiStatus() {
                upload_status.html("<span class=\"text-primary\">Uploading....</span>");
            };

            var uploadedUiStatus = function uploadedUiStatus(_ref2) {
                var path = _ref2.path;
                image_input.val(path);
                upload_status.html("<span class=\"text-success\">Upload Completed</span>");
                image_preview.css({
                    opacity: 1
                });
            };

            var imageUploadChooseUiStatus = function imageUploadChooseUiStatus() {
                image_input.attr('name', 'image');
                image_preview.css({
                    opacity: 0.3
                });
                upload_status.html("<span class=\"text-danger\">Please Upload Image</span>");
            };

            var previewImage = function previewImage(_ref3) {
                var preview = _ref3.preview,
                    file = _ref3.file;
                var reader = new FileReader();
                reader.addEventListener("load", function () {
                    preview.src = reader.result;
                    imageUploadChooseUiStatus();
                }, false);

                if (file) {
                    reader.readAsDataURL(file);
                }
            };

            var ImageUploadEvent = function ImageUploadEvent(e) {
                e.preventDefault();
                var fileField = document.querySelector('input[type="file"]');
                ImageUploadRequest({
                    url: $(this).attr('action'),
                    image: fileField.files[0]
                }).then(function (response) {
                    return response.json();
                }).then(function (result) {
                    console.log('Success:', result);

                    if (result.status === 1) {
                        uploadedUiStatus({
                            path: result.path
                        });
                    }
                })["catch"](function (error) {
                    console.error('Error:', error);
                });
                loadingUiStatus();
            };

            var previewImageEvent = function previewImageEvent() {
                var preview = document.querySelector('img');
                var file = document.querySelector('input[type=file]').files[0];
                previewImage({
                    preview: preview,
                    file: file
                });
            };

            image_upload_button.submit(ImageUploadEvent);
            choose_image_button.change(previewImageEvent);
        };

        /***/
    }),

    /***/ 2:
    /*!********************************************!*\
      !*** multi ./resources/js/image_upload.js ***!
      \********************************************/
    /*! no static exports found */
    /***/ (function (module, exports, __webpack_require__) {

        module.exports = __webpack_require__(/*! C:\Users\Kyaw Thi Ha\Desktop\laracast_laravel_tutorial\resources\js\image_upload.js */"./resources/js/image_upload.js");


        /***/
    })

    /******/
});
