//refresh web
function hoursToMilliseconds(hours) { return hours * 60 * 60 * 1000; }

setTimeout(() => {
    location.reload()
 }, hoursToMilliseconds(1));