import './bootstrap';
import 'flowbite';
import Quill from 'quill';
import 'quill/dist/quill.snow.css';
// import "quill/dist/quill.core.css";

window.Quill = Quill;
// document.addEventListener("DOMContentLoaded", () => {
//    const editor = document.getElementById("editor");

//    if (editor) {
//       const quill = new Quill(editor, {
//          theme: "snow",
//          modules: {
//             toolbar: [
//                [{ 'header': [1, 2, 3, false] }],
//                ['bold', 'italic', 'underline', 'strike'],
//                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
//                ['blockquote', 'code-block'],
//                ['link', 'image'],
//                [{'direction': 'rtl'}, {'script': 'sub'}, {'script' : 'super'}],
//                ['clean']
//             ]
//          }
//       });

//       // sync ke hidden textarea
//       const hiddenInput = document.getElementById("hidden-input");
//       const form = editor.closest("form");

//       if (form && hiddenInput) {
//          form.addEventListener("submit", () => {
//             hiddenInput.value = quill.root.innerHTML;
//          });
//       }
//    }
// });
