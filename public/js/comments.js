/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/comments.js":
/*!**********************************!*\
  !*** ./resources/js/comments.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.onload = function () {
  var app = $("#comments");
  var API = {
    ROOT_URL: "http://localhost:8000/article/".concat(app.attr('article_id'), "/comments"),
    HEADERS: {
      'Content-Type': 'application/x-www-form-urlencoded',
      'Accept': 'application/json',
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    LIST: function LIST() {
      return "".concat(this.ROOT_URL);
    },
    REPLY: function REPLY(id) {
      return "".concat(this.ROOT_URL, "/").concat(id);
    },
    UPDATE: function UPDATE(id) {
      return "".concat(this.ROOT_URL, "/").concat(id);
    },
    CREATE: function CREATE() {
      return "".concat(this.ROOT_URL);
    },
    DELETE: function DELETE(id) {
      return "".concat(this.ROOT_URL, "/").concat(id);
    }
  };

  var CreateRequest = function CreateRequest(_ref) {
    var text = _ref.text;
    var formData = new URLSearchParams();
    formData.append('text', text);
    return fetch(API.CREATE(), {
      method: 'POST',
      headers: API.HEADERS,
      body: formData
    });
  };

  var CreateEvent = function CreateEvent() {
    return function (e) {
      e.preventDefault();
      var commentInput = $('textarea[name="text"]');
      var text = commentInput.val();
      CreateRequest({
        text: text
      }).then(function (response) {
        return response.json();
      }).then(function (data) {
        console.log('Success:', data);
        commentInput.val('');
        getComments();
      })["catch"](function (error) {
        console.error('Error:', error);
      });
    };
  };

  var DeleteRequest = function DeleteRequest(id) {
    return fetch(API.DELETE(id), {
      method: "DELETE",
      headers: API.HEADERS
    });
  };

  var DeleteEvent = function DeleteEvent(id) {
    return function (e) {
      e.preventDefault();
      DeleteRequest(id).then(function (response) {
        return response.json();
      }).then(function (data) {
        if (data.status === 1) {
          console.log('Success:', data);
          getComments();
        } else {
          alert("You don't delete");
        }
      })["catch"](function (error) {
        console.error('Error:', error);
      });
    };
  };

  var ReplyRequest = function ReplyRequest(_ref2) {
    var id = _ref2.id,
        text = _ref2.text;
    var formData = new URLSearchParams();
    formData.append('text', text);
    return fetch(API.REPLY(id), {
      method: 'POST',
      headers: API.HEADERS,
      body: formData
    });
  };

  var ReplyEvent = function ReplyEvent(id) {
    return function (e) {
      e.preventDefault();
      var reply = prompt("Reply comment");
      ReplyRequest({
        id: id,
        text: reply
      }).then(function (response) {
        return response.json();
      }).then(function (data) {
        getComments();
      })["catch"](function (error) {
        console.error('Error:', error);
      });
    };
  };

  var EditRequest = function EditRequest(_ref3) {
    var id = _ref3.id,
        text = _ref3.text;
    var formData = new URLSearchParams();
    formData.append('text', text);
    return fetch(API.UPDATE(id), {
      method: "PUT",
      headers: API.HEADERS,
      body: formData
    });
  };

  var EditEvent = function EditEvent(_ref4) {
    var id = _ref4.id,
        oldComment = _ref4.oldComment;
    return function (e) {
      e.preventDefault();
      var text = prompt("Edit comment", oldComment);
      EditRequest({
        id: id,
        text: text
      }).then(function (response) {
        return response.json();
      }).then(function (data) {
        if (data.status === 1) {
          console.log('Success:', data);
          getComments();
        } else {
          alert("You don't edit");
        }
      })["catch"](function (error) {
        console.error('Error:', error);
      });
    };
  };

  var CommentComponent = function CommentComponent(_ref5) {
    var id = _ref5.id,
        user_name = _ref5.user_name,
        comment = _ref5.comment,
        created_at = _ref5.created_at,
        comments = _ref5.comments;
    var CommentDiv = $("<div></div>", {
      "class": "media mb-4"
    });
    var ReplyCommentComponent = $("<div></div>");

    if (comments) {
      comments.forEach(function (comment, index) {
        console.log(comment);
        ReplyCommentComponent.append(CommentComponent({
          id: comment.id,
          user_name: comment.user.name,
          comment: comment.text,
          created_at: comment.created_at,
          comments: comment.comments
        }));
      });
    }

    var UserProfile = $("<img/>", {
      "class": "d-flex mr-3 rounded-circle",
      "src": "https://i.pravatar.cc/50?u=".concat(user_name),
      "alt": ""
    });
    var CommentBody = $("<div></div>", {
      "class": "media-body"
    });
    var CommentAction = $("<div></div>");
    var DeleteButton = $("<a></a>", {
      text: "Delete",
      href: "",
      on: {
        click: DeleteEvent(id)
      }
    });
    var ReplyButton = $("<a></a>", {
      text: "Reply",
      style: "margin-left:12px",
      href: "",
      on: {
        click: ReplyEvent(id)
      }
    });
    var EditButton = $("<a></a>", {
      text: "Edit",
      style: "margin-left:12px",
      href: "",
      on: {
        click: EditEvent({
          id: id,
          oldComment: comment
        })
      }
    });
    CommentAction.append(DeleteButton);
    CommentAction.append(ReplyButton);
    CommentAction.append(EditButton);
    var CommentHeader = "\n                    <h5 class=\"mt-0\">".concat(user_name, " <span style=\"font-size: 0.7rem;color:blue;\"> ").concat(new Date(created_at).toDateString(), "</span></h5>\n                    ");
    CommentBody.append(CommentHeader);
    CommentBody.append(comment);
    CommentBody.append(CommentAction);
    CommentBody.append(ReplyCommentComponent);
    CommentDiv.append(UserProfile);
    CommentDiv.append(CommentBody);
    return CommentDiv;
  };

  var comments_render = function comments_render(data) {
    $('#comments').children().remove();
    data.forEach(function (comment, index) {
      $('#comments').append(CommentComponent({
        id: comment.id,
        user_name: comment.user.name,
        comment: comment.text,
        created_at: comment.created_at,
        comments: comment.comments
      }));
    });
  };

  var getComments = function getComments() {
    fetch(API.LIST()).then(function (response) {
      return response.json();
    }).then(function (data) {
      comments_render(data);
    })["catch"](function (error) {
      console.error('Error:', error);
    });
  };

  getComments();
  $('#comments_create_form').submit(CreateEvent());
};

/***/ }),

/***/ 1:
/*!****************************************!*\
  !*** multi ./resources/js/comments.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\Kyaw Thi Ha\Desktop\laracast_laravel_tutorial\resources\js\comments.js */"./resources/js/comments.js");


/***/ })

/******/ });