import Prism from "prismjs";
import 'prismjs/components/prism-markup.min.js';
import 'prismjs/plugins/line-numbers/prism-line-numbers.min.js';
import 'prismjs/plugins/toolbar/prism-toolbar.min.js';
import 'prismjs/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js';
import 'prismjs/plugins/normalize-whitespace/prism-normalize-whitespace.min.js';

document.addEventListener('DOMContentLoaded', () => {
    Prism.plugins.NormalizeWhitespace.setDefaults({
        'remove-trailing': true,    // Xóa khoảng trắng thừa ở cuối dòng
        'remove-indent': true,      // Xóa thụt lề (khoảng trắng đầu dòng)
        'left-trim': true,          // Xóa khoảng trắng ở đầu toàn bộ khối mã
        'right-trim': true,         // Xóa khoảng trắng ở cuối toàn bộ khối mã
        'remove-initial-line-feed': false, // Xóa dòng trống đầu tiên
        /*'break-lines': 80,        // Tự động ngắt dòng nếu dòng dài hơn 80 ký tự
        'indent': 2,               // Thêm thụt lề (2 khoảng trắng) cho mỗi cấp
        'tabs-to-spaces': 4,       // Chuyển tab thành 4 khoảng trắng
        'spaces-to-tabs': 4*/      // Chuyển 4 khoảng trắng thành 1 tab
    });

    Prism.highlightAll();
});


