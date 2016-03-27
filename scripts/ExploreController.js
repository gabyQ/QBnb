var slider;

$(document).ready(function(){
    initSlider();
});

function initSlider(){
    slider = $("#price-slider").slider({
        range: true,
        min: 0,
        max: 1000,
        values: [0, 1000],
        change: function (event, ui) {

        }
    }).each(function () {
        var opt = $(this).data().uiSlider.options;

        // Get the number of possible values
        var vals = opt.max - opt.min;
        // Position the labels
        for (var i = 0; i <= vals; i+=200) {

            // Create a new element and position it with percentages
            var el = $('<label>' + (i + opt.min) + '</label>').css('left', (i / vals * 100) + '%');

            // Add the element inside #slider
            $("#price-slider").append(el);
        }
    });
}

function ExploreViewModel(){
    var self = this;
    self.districts = ko.observableArray(['Downtown', 'The Beaches', 'Entertainment', 'Distillery', 'University']);

    self.district = ko.observable();
    self.hasFireplace = ko.observable();
    self.hasPool = ko.observable();
    self.hasDen = ko.observable();
    self.hasBackyard = ko.observable();
    self.hasGym = ko.observable();
    self.hasPoolTable = ko.observable();

    self.isEntireHome = ko.observable();
    self.isPrivateRoom = ko.observable();
    self.isSharedRoom = ko.observable();

    self.minPrice = ko.observable();
    self.maxPrice = ko.observable();

    self.search = function(){

    }
}

var exploreVM = new ExploreViewModel();
ko.applyBindings(exploreVM);