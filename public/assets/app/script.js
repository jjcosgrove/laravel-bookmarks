$(document).ready(function() {
    EnableUserMessages();
    EnableNewBookmarkForm();
    EnableVisibilityFilter();
    EnableTagFilter();
    EnableSearchFilter();
});

/**
 * simple function to fade out any messages passed to the page
 */
function EnableUserMessages() {
    $('.user-message').fadeTo(2000, 500).slideUp(500, function() {
        $('.user-message').remove();
    });
}

/**
 * sets up the new bookmark form and populates
 * autocomplete for tags
 */
function EnableNewBookmarkForm() {
    //new bookmark action/shortcut
    $('.action.new-bookmark').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();

        //show the new bookmark form
        $('.new-bookmark-container').removeClass('hidden');
    });

    //scrape the tags and set up autocomplete for tagit
    var tags_array = [];
    $('.tag-filter').each(function() {
        tags_array.push($(this).find('.tag-name').text());
    });

    //initiate tagit with autocomplete
    $('input[name="tags"]').tagit({
        placeholderText: 'Add tags...',
        availableTags: tags_array
    });

    //clear the form if cancelled
    $('.bookmark-form .cancel').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $('.bookmark-form').trigger('reset');
        $('input[name="tags"]').tagit('removeAll');
        $('.new-bookmark-container').addClass('hidden');
    });
}

/**
 * filters the view based on view selection in left-side menu
 */
function EnableVisibilityFilter() {
    $('.visibility-filter').on('click', function() {

        //clear all and set chosen as selected
        $('.tag-filter').removeClass('selected');
        $('.visibility-filter').removeClass('selected');
        $(this).addClass('selected');

        //hide all bookmarks
        $('.bookmark-item').hide();

        //get the filter value
        var visibilityFilter = $(this).find('.filter-name').text().toLowerCase();

        //filter based on selection
        switch (visibilityFilter) {
            case 'all':
                $('.bookmark-item').show();
                break;
            case 'private':
                $('.bookmark-item[private="true"]').show();
                break;
            case 'public':
                $('.bookmark-item:not([private="true"])').show();
                break;
        }
    });
}

/**
 * filters the view based on tag selection in left-side menu
 */
function EnableTagFilter() {
    $('.tag-filter').on('click', function() {

        //clear all and set chosen as selected
        $('.visibility-filter').removeClass('selected');
        $('.tag-filter').removeClass('selected');
        $(this).addClass('selected');

        //hide all bookmarks
        $('.bookmark-item').hide();

        //get the filter value
        var tagFilterValue = $(this).find('.tag-name').text().trim();

        //now cycle through and show any bokmarks with matching tags
        $('.bookmark-item').each(function() {
            $(this).find('.tag').each(function() {
                if ($(this).text().trim() === tagFilterValue) {
                    $(this).closest('.bookmark-item').show();
                    return false;
                }
            });
        });
    });

}

/**
 * Enables the search functionality
 */
function EnableSearchFilter() {
    $('.search-filter').on('keyup', function() {

        //clear all filters
        $('.visibility-filter').removeClass('selected');
        $('.tag-filter').removeClass('selected');

        //hide all bookmarks
        $('.bookmark-item').hide();

        //get the search filter value
        var searchFilterValue = $(this).val().trim().toLowerCase();

        //check search term against each bookmark
        $('.bookmark-item').each(function() {

            //add all the tags to a 'searchString'
            var searchString = "";
            $(this).find('.tag').each(function() {
                searchString = searchString.concat($(this).text().trim().toLowerCase());
            });

            //add in the name
            searchString = searchString.concat($(this).closest('.bookmark-item').find('.name').text().trim().toLowerCase());

            //add in the url
            searchString = searchString.concat($(this).closest('.bookmark-item').find('.url').text().trim().toLowerCase());

            //add in the username
            searchString = searchString.concat($(this).closest('.bookmark-item').find('.username').text().trim().toLowerCase());

            //show any bookmarks that match the search
            if (searchString.indexOf(searchFilterValue) >= 0)
                $(this).closest('.bookmark-item').show();
        });
    });
}