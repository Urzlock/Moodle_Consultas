

function getCourses(str){
    let consult = "1"
    if(str != ""){
        let xmlhttp = new XMLHttpRequest()
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 & this.status == 200){
                document.getElementById("showtext").innerHTML = this.responseText;
            }
        }
        switch (key) {
            //CASO 1
            case "1":
                xmlhttp.open("GET","php/userCount.php?q="+str,true);
                xmlhttp.send();
                break;
                //CASO 2
            case "2":
                xmlhttp.open("GET","php/courseCount.php?q="+str,true);
                xmlhttp.send();
                break;
                //CASO 3
            case "3":
                xmlhttp.open("GET","php/courseCategories.php?q="+str,true);
                xmlhttp.send();
                break;
                //CASO 4
            case "4":
                xmlhttp.open("GET","php/studentsByCourse.php?q="+str,true);
                xmlhttp.send();
                break;
                //CASO 6
            case "5":
                xmlhttp.open("GET","php/enrolmentByCourse.php?q="+str,true);
                xmlhttp.send();
                break;
                //CASO 7
            case "6":
                xmlhttp.open("GET","php/assigmentByCourse.php?q="+str,true);
                xmlhttp.send();
                break;
                //CASO 8
            case "7":
                xmlhttp.open("GET","php/calificationAssigment.php?q="+str,true);
                xmlhttp.send();
                break;
                //CASO 9
            case "8":
                xmlhttp.open("GET","php/quizListByCourse.php?q="+str,true);
                xmlhttp.send();
                break;
                //CASOS 10 Y 11
            default:
                xmlhttp.open("GET","php/averageQuiz.php?q="+str,true);
                xmlhttp.send();
                break;
                
        }
        
    }
}

getCourses("CURSOEJEMPLO1");