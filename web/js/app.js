/**
 * FileReader class.
 */

(function() {
    function FileReader() {
        this.init();
    }

    /**
     * Initialization of FileReader class.
     */
    FileReader.prototype.init = function() {
        this.addEventListeners();
    };

    /**
     * Add events for elements.
     */
    FileReader.prototype.addEventListeners = function() {
        var that = this;
        var items = document.querySelectorAll('.js-item');
        items.forEach(function(item) {
            item.addEventListener('click', function() {
                var path = item.getAttribute('data-path');
                var dir = item.getAttribute('data-directory');
                window.path = path;
                that.loadFilesList(path, dir);
            });
        });

        var backItem = document.getElementById('js-back-item');
        var backPath, newBackPath, dir, pos;
        if (backItem !== undefined && backItem != null) {
            backItem.addEventListener('click', function() {
                backPath  = this.getAttribute('data-path');
                dir  = this.getAttribute('data-directory');
                that.loadFilesList(backPath, dir);
                pos = backPath.lastIndexOf('/');
                newBackPath = backPath.slice(0, pos);

                if (newBackPath == '') {
                    window.path = '/';
                } else {
                    window.path = newBackPath;
                }
            });
        }
    };

    /**
     * Get list of directories and files.
     *
     * @param {string} path
     * @param {string} dir
     */
    FileReader.prototype.loadFilesList = function(path, dir) {
        var that = this;
        fetch('/api/v1/files', {
            method: 'POST',
            headers: {
                "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
            },
            body: 'dir=' + dir + '&path=' + path
        }).then(function(response) {
            if (response.ok && response.status === 200) {
                return response.json();
            }
        }).then(function(response) {
            that.renderFilesList(response);
        });
    };

    /**
     * Render list of directories and files.
     *
     * @param {string|array} list
     */
    FileReader.prototype.renderFilesList = function(list) {
        var that = this,
            listContainer = document.getElementById('directory-list'),
            listItems = '';
        if (window.path !== undefined) {
            listItems += '<li id="js-back-item" class="directory" data-path="' + window.path + '" data-directory="..">..</li>';
        }
        listContainer.innerHTML = '';
        if (list.length > 0) {
            list.forEach(function(item) {
                listItems += that.createItem(item);
            });
        } else {
            for (var prop in list) {
                var item = list[prop];
                listItems += that.createItem(item);
            }
        }
        listContainer.innerHTML = listItems;
        this.addEventListeners();
    };

    /**
     * Create item of directories and files list.
     *
     * @param {object} item
     * @returns {string}
     */
    FileReader.prototype.createItem = function(item) {
        var listItem;
        if (item.type == 'dir') {
            listItem = '<li class="js-item directory" data-path="' + item.path + '" data-directory="' + item.name + '">' + item.name + '</li>';
        } else {
            listItem = '<li class="file" data-path="' + item.path + '" data-directory="' + item.name + '">' + item.name + '</li>';
        }
        return listItem;
    };

    window.onload = function() {
        var fileReader = new FileReader();
    }
})();