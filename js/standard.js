// These functions are to find the page the user entered if it exists, and filll the page with the corresponding content
//From here:
function getTitle() {
    var url = window.location.href; //url in the form http://domainname.com/whatevertheytypedin
    url = url.split("/"); //make it into an array splitting by /
    url = url[3];  // url = whatevertheytypedin 
    $.ajax({
        data: null,
        url: '/cms/getPageNames2.php',
        method: 'POST', // or GET
        success: function(msg) {
             compareTitles(msg, url);   
        }
    }); 
}
function compareTitles(pages, url) {
    pages = pages.split("<br>");
    var found = false;
    var pageName;
    for (var i = 0; i < pages.length-1; i++) {
        if (url.toLowerCase() === pages[i].toLowerCase()) {
            found = true;
            pageName = pages[i];
            break;
        }
    }
    if (found) foundPage(pageName);
    else pageNotFound();
}
function foundPage(page) {
    function fillPageBody(elements) {
        document.getElementsByTagName("body")[0].innerHTML = elements;
    }
    function fillPageHead(elements) {
        document.getElementsByTagName("head")[0].innerHTML = elements;
    }
    function addTitle(title) {
        document.getElementsByTagName("head")[0].innerHTML = document.getElementsByTagName("head")[0].innerHTML+("<title>"+title+"</title>");
    }
    getDatabaseValue("adambuja_Pages", page, "Content", "id", "1", fillPageBody);
    getDatabaseValue("adambuja_Pages", page, "Head", "id", "1", fillPageHead);
    getDatabaseValue("adambuja_Pages", page, "Title", "id", "1", addTitle);
}
function pageNotFound() {
    document.getElementsByTagName('body')[0].append('Not Found!')
}
function getDatabaseValue(db, tableName, column, value, id, completeFunction) { // SELECT column FROM db WHERE value = id 
    $.ajax({
        data: 'dbname=' + db + '&tableName=' + tableName + "&column=" + column + "&value=" + value + "&id=" + id,
        url: '/cms/getTableValue.php',
        method: 'POST', //  or GET
        success: function(msg) {completeFunction(msg);}
    });
} 
// To here.
// Following functions are for whatever the page needs - think about maybe implementing js file adding to increase modularity


