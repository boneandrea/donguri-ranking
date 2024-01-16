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

let currentButton = null

// 入力開始
const myModal = new bootstrap.Modal(document.getElementById('myModal'), {})
q('#score').addEventListener('click', (e) => {
  if (!e.target.classList.contains('btn')) return
  const button = e.target
  const tr = button.closest('tr')
  const hole = getHoleAndName(tr, button)
  q('#hole').innerText = hole
  myModal.show()
  currentButton = e.target
})

const getHoleAndName = (tr, button) => {
  const hole = qaa('button', tr).indexOf(button) + 1
  const name = q('th', tr).innerText
  return `${hole}: player ${name}`
}

// スコア入力
q('#myModal').addEventListener('click', (e) => {
  if (!e.target.classList.contains('btn')) return
  if (e.target.classList.contains('close')) return

  const score = e.target.innerHTML
  if (currentButton) {
    currentButton.innerHTML = score
  }
  myModal.hide()
  update()
})

// 全部クリア
q('#clear').addEventListener('click', () => {
  if (!confirm('Clear all??')) return

  qaa('td button', q('tbody')).forEach((e) => (e.innerHTML = '-'))
  update()
  clearData()
})

q('h1 span').innerText = `(${new Date().toLocaleDateString('ja-JP')})`

// 画面アップデート
const update = () => {
  const trs = qaa('#score tbody tr')
  const data = []
  trs.forEach((tr, tr_index) => {
    data[tr_index] = []
    const tds = qaa('td button', tr)
    const total1 = tds
      .slice(0, 9)
      .map((td) => {
        const _score = parseInt(td.innerHTML)
        const score = isNaN(_score) ? 0 : _score
        data[tr_index].push(score)
        return score
      })
      .reduce((sum, score) => sum + score)
    q('.total1', tr).innerText = total1

    const total2 = tds
      .slice(9, 18)
      .map((td) => {
        const _score = parseInt(td.innerHTML)
        const score = isNaN(_score) ? 0 : _score
        data[tr_index].push(score)
        return score
      })
      .reduce((sum, score) => sum + score)

    q('.total2', tr).innerText = total2
    q('.total3', tr).innerText = total1 + total2
  })
  storeData(data)
}

const restoreData = () => {
  const lastData = localStorage.getItem('score')
  if (lastData) {
    console.log('restore editing data')
    const parsed = JSON.parse(lastData)

    const trs = qaa('#score tbody tr')
    parsed.forEach((userData, tr_index) => {
      const button = qaa('td button', trs[tr_index])
      userData.forEach((score, hole_index) => {
        button[hole_index].innerText = score ? score : '-'
      })
    })
  }
}

const storeData = (data) => {
  localStorage.setItem('score', JSON.stringify(data))
}

const clearData = () => {
  localStorage.removeItem('score')
}

const members = ['J', 'T', 'N']
const displayMembers = () => {
  members.forEach((name) => {
    const x = q('#template tr').cloneNode(true)
    q('tbody').appendChild(x)
    q('th', x).innerText = name
  })
}

displayMembers()
restoreData()
update()

new ScrollHint(".main");
