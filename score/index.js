'use strict'

/* eslint-disable */
const q = (s, root) => {
    if (root) {
        return root.querySelector(s)
    }
    return document.querySelector(s)
}
const qa = (s, root) => {
    if (root) {
        return root.querySelectorAll(s)
    }
    return document.querySelectorAll(s)
}

const qaa = (s, root) => {
    return [...qa(s, root)]
}

/* eslint-enable */

let currentButton=null
const myModal = new bootstrap.Modal(document.getElementById('myModal'), {})
q("#score").addEventListener("click", e=>{
    if(!e.target.classList.contains("btn")) return
    console.log(e.target)
    myModal.show()
    currentButton=e.target
})


q("#myModal").addEventListener("click", e=>{
    if(!e.target.classList.contains("btn")) return

    const score=e.target.innerHTML
    if(currentButton){
        currentButton.innerHTML=score
    }
    myModal.hide()
    update()
})

q("#clear").addEventListener("click",()=>{
    qaa("td button", q("tbody")).forEach(e=>e.innerHTML="-")
    update()
})

const update=()=>{
    const trs=qaa("tbody tr")
    trs.forEach(tr=>{
        const tds=qaa("td button", tr)
        const total1=tds.slice(0,9).map(td=>{
            const score= parseInt(td.innerHTML)
            return isNaN(score) ? 0 : score
        }).reduce((sum, score) => sum+score)
        q(".total1", tr).innerText=total1

        const total2=tds.slice(9,18).map(td=>{
            const score= parseInt(td.innerHTML)
            return isNaN(score) ? 0 : score
        }).reduce((sum, score) => sum+score)

        q(".total2", tr).innerText=total2
        q(".total3", tr).innerText=total1+total2
    })
}
