/**
 * Created by texas on 3/6/18.
 */

(function() {
    function FileReader() {
        this.init();
    }

    FileReader.prototype.init = function() {
        this.addEventListeners();
    };

    FileReader.prototype.addEventListeners = function() {
        var that = this;
        var items = document.querySelectorAll('.js-item');
        items.forEach(function(item) {
            item.addEventListener('click', function() {
                var path = item.getAttribute('data-path');
                var dir = item.getAttribute('data-directory');
                that.loadFilesList(dir, path);
            });
        });
    };

    FileReader.prototype.loadFilesList = function(path, dir) {
        var that = this;
        var fullPath = path + dir;
        fetch('/api/v1/files/' + fullPath, {
            method: 'GET'
        }).then(function(response) {
            if (response.ok && response.status === 200) {
                return response.json();
            }
        }).then(function(response) {
            console.log(response);
            that.renderFilesList(response);
        });
    };

    FileReader.prototype.renderFilesList = function(list) {
        var listContainer = document.getElementById('directory-list');
        listContainer.html = '';
    };

    window.onload = function() {
        var fileReader = new FileReader();
    }
})();