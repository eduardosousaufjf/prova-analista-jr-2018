(function($, window) {
    $.fn.replaceOptions = function(options) {
        var self, $option;

        this.empty();
        self = this;

        $.each(options, function(index, option) {
            $option = $("<option></option>")
                .attr("value", option.cidade_id)
                .text(option.cidade_nome);
            self.append($option);
        });
    };
})(jQuery, window);


$(document).ready(function () {
    $("#estado_id").on("change", function () {
        var opcao = $("#estado_id").children("option:selected").val();
        $.ajax({
            url: "http://localhost:8080/user/filter/" + opcao, success: function (result) {

                $("#cidade_id").replaceOptions(result);
                console.log(result)
            },
            error: function (err) {
                console.log(err)
            }
        });
    })
})


