function addDropDownOptions(selector, options) {
    var i;
    for (i = 0; i < options.length; i++) {
        // create the dom element for an dropdown option
        var option = $("<option></option>", { name: encodeURIComponent(options[i]) });
        option.append(options[i]);

        // add the dropdown entry to the dropdown menu
        $(selector).append(option);
    }
}

// Creates an associative of query string parameters and values
function getQueryStrParams() {
    // get the query string from the current url
    var queryString = location.search;
    var params = {};
    if (queryString.length > 1 && queryString.substring(0, 1) === "?") {
        // load all query string field-value pairs into an associative array
        var queries = queryString.substring(1, queryString.length).split("&");
        var i;
        for (i = 0; i < queries.length; i++) {
            var splitQuery = queries[i].split("=");
            // only add valid field-value pairs
            if (splitQuery.length === 2) {
                // convert special characters to regular characters when adding to the associative array
                // handle '+'s as a form replacement for a space
                params[decodeURIComponent(splitQuery[0])] = decodeURIComponent(splitQuery[1].replace(/[+]/g, " "));
            }
        }
    }
    return params;
}

function getQueryString(params) {
    result = "?";
    var key;
    for (key in params) {
        result += encodeURIComponent(key) + "=" + encodeURIComponent(params[key]) + "&";
    }
    // remove trailing '&' and use '+' instead of "%20" for spaces to match the form submission
    result = result.substring(0, result.length - 1).replace(/%20/g, "+");
    return result;
}

$(document).ready(function () {
    //todo: get art forms
    var artForms = ["All"].concat(["Drama", "Visual Arts", "Dance", "Music", "Film", "Poetry", "Other"]);
    addDropDownOptions("#artForm", artForms);

    //todo: get languages
    var languages = ["All"].concat(["English", "Spanish"]);
    addDropDownOptions("#language", languages);

    //todo: get genres
    var genres = ["All"].concat(["Genre1", "Genre2"]);
    addDropDownOptions("#genre", genres);

    // get the query string as an associative array
    var searchParams = getQueryStrParams();
    // add a default page number
    if (searchParams.hasOwnProperty("page")) {
        searchParams.page = parseInt(searchParams.page);
        if (isNaN(searchParams.page) || searchParams.page <= 0) {
            searchParams.page = 1;
        }
    } else {
        searchParams.page = 1;
    }

    // fill in the search form with the current search
    $("#keyword").val(searchParams.keyword || "");
    $("#artForm").val(searchParams.art_form || "All");
    $("#language").val(searchParams.language || "All");
    $("#genre").val(searchParams.genre || "All");

    //todo: get search results
    var searchResults = [/*{ id: 1, projectName: "project 1", composer: "composer 1" }, { id: 2, projectName: "project 2", composer: "composer 2" }*/];
    var curResult;
    for (curResult = 0; curResult < searchResults.length; curResult++) {
        var searchResult = $("<div></div>");
        var resultLink = $("<a></a>", { href: "media.php?id=" + searchResults[curResult].id })
        resultLink.text("\"" + searchResults[curResult].projectName + "\" - " + searchResults[curResult].composer);
        searchResult.append(resultLink);
        $("#searchResults").append(searchResult);
    }
    
    //todo: get numPages
    var numPages = 1;//Number.POSITIVE_INFINITY;

    // set up the previous button
    if (searchParams.page > 1) {
        searchParams.page--;
        $("#previous").parent().attr("href", "search.php" + getQueryString(searchParams));
        searchParams.page++;
    } else {
        $("#previous").prop("disabled", true);
    }

    // set up the page numbers
    var pageNumIdx;
    for (pageNumIdx = Math.max(1, searchParams.page - 2) ; pageNumIdx <= Math.min(numPages, searchParams.page + 2) ; pageNumIdx++) {
        var curPageNum = searchParams.page;
        
        searchParams.page = pageNumIdx;
        var pageNumLink;
        if (pageNumIdx !== curPageNum) {
            pageNumLink = $("<a></a>", { href: "search.php" + getQueryString(searchParams) })
        } else {
            pageNumLink = $("<span></span>")
        }
        pageNumLink.html(pageNumIdx);
        $("#pageNumbers").append(pageNumLink);

        searchParams.page = curPageNum;
    }

    // set up the next button
    if (searchParams.page + 1 < numPages) {
        searchParams.page++;
        $("#next").parent().attr("href", "search.php" + getQueryString(searchParams));
        searchParams.page--;
    } else {
        $("#next").prop("disabled", true);
    }
})