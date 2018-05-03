$(function(){
    $(document).on("click", "#bootlint-check", function(){
        var checkBootlint = $('script[src="https://maxcdn.bootstrapcdn.com/bootlint/latest/bootlint.min.js"]').length;
        if (!checkBootlint){
            var s=document.createElement("script");
            s.src="https://maxcdn.bootstrapcdn.com/bootlint/latest/bootlint.min.js";
            document.body.appendChild(s);
            s.onload=function(){
                bootlint.showLintReportForCurrentDocument([]);
            };
        }else{
            bootlint.showLintReportForCurrentDocument([]);
        }
    });
});