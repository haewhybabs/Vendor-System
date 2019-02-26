var data = [ 
 {"Id": 10004, "PageName": "club"}, 
 {"Id": 10040, "PageName": "qaz"}, 
 {"Id": 10059, "PageName": "jjjjjjj"}
];

$.each(data, function(i, item) {
    alert(data[i].PageName);
});​

$.each(data, function(i, item) {
    alert(item.PageName);
});​
these two options work well, unless you have something like:

var data.result = [ 
 {"Id": 10004, "PageName": "club"}, 
 {"Id": 10040, "PageName": "qaz"}, 
 {"Id": 10059, "PageName": "jjjjjjj"}
];

$.each(data.result, function(i, item) {
    alert(data.result[i].PageName);
});​