function getCalculation(timeArr) {
    
    if (timeArr !== undefined || timeArr.length !== 0) {
        console.log(timeArr.pop() - timeArr[0]);
        timeArr = [];
    }
}