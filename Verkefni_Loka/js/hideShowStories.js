

document.addEventListener('DOMContentLoaded',function()
{ 
    // Adds hide/show on click to the following elements
    showHide("storyOne", "ferrantiMark");
    showHide("storyTwo","williamHiginBotham");
    showHide("storyThree","theBrownBox");
    showHide("storyFour","atari");
    showHide("storyFive","videoGameCrash");
    showHide("storySix","nintendo");
    showHide("storySeven","consoleWar");
    showHide("storyEight","pcGaming");
    showHide("storyNine","today");
});

// A function to hide or show an element when
// another element is clicked
function showHide(clickedID, showID){
    // The elements
    var clickeddiv = document.getElementById(clickedID);
    var item = document.getElementById(showID);
    // Listen for the click
    clickeddiv.addEventListener("click",function(){
        // If the item is invisible
        if(item.offsetParent === null){
            // make it visible
            item.style.display = 'initial';
        }
        // else hide it
        else item.style.display = 'none';
    });
}