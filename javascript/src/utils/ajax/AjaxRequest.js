/**
 * Created by Adrian Moraret on 3/18/2017.
 */
class AjaxRequest {

    post(url, contentType, data){
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
            xhr.open('POST', url);
            xhr.setRequestHeader("Content-Type", contentType);
            xhr.send(data);
        });
    }
}

export default AjaxRequest;