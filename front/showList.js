import showUpdatePage from './showUpdatePage.js';
import doDelete from './doDelete.js';

function showDeleteList(){
    showList("delete");
}

function showUpdateList(){
    showList("update");
}

function showList(type){
    axios.get("../backend/public/index.php?action=getUsers")
    .then(res => {
        let response = res['data'];
        switch(response['status']){
            case 200:
                const rows = response['result'];
                let str = `<table class="custom-table">`;
                // 表頭
                str += `<thead><tr>`;
                str += `<th>選擇</th>`;
                str += `<th>密碼</th>`;
                str += `<th>email</th>`;
                str += `<th>電話</th>`;
                str += `</tr></thead>`;
                // 表身
                str += `<tbody>`;
                rows.forEach(element => {
                    str += "<br><tr>";
                    const idstr = "<input type='radio' id='id' name='id' value='" + element['id'] + "'>";
                    str += "<td>" + idstr + "</td>";
                    str += "<td>" + element['password'] + "</td>";
                    str += "<td>" + element['email'] + "</td>";
                    str += "<td>" + element['phone'] + "</td>";
                    str += "</tr>";
                });
                str += "</tbody></table>";

                // 根據 type 產出修改或刪除按鈕
                if(type === "delete"){
                    str += `<button id="doDelete" class="custom-btn">刪除</button>`;
                    document.getElementById("content").innerHTML = str;
                    document.getElementById("doDelete").onclick = function(){
                        doDelete();
                    };
                }
                else{
                    str += `<button id="showUpdatePage" class="custom-btn">修改</button>`;
                    document.getElementById("content").innerHTML = str;
                    document.getElementById("showUpdatePage").onclick = function(){
                        showUpdatePage();
                    };
                }
                break;
            default:
                document.getElementById("content").innerHTML = response['message'];
                break;
        }
    })
    .catch(err => {
        document.getElementById("content").innerHTML = err;  
    });
}
export { showUpdateList, showDeleteList };
