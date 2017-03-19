/**
 * Created by Adrian Moraret on 3/18/2017.
 */
class AjaxRequest {
    get(url){
        let xhr = new XMLHttpRequest();
        return new Promise((resolve, reject) => {
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        resolve(JSON.parse(xhr.responseText));
                    } else {
                        reject(xhr.responseText);
                    }
                }
            };
            xhr.open('GET', url);
            xhr.send();
        });
    }
}

export default AjaxRequest;