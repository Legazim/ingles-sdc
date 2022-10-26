import React from 'react';

export default function Cards() {
  return (
    <div className='exercise card'>
      <div
        className='cover'
        style='
          background-image: linear-gradient(
              180deg,
              transparent 50%,
              var(--clr-bg) 100%
            ),
            url(http://unsplash.it/600/401);
        '
      ></div>
      <div className='description'>
        <div className='status'>
          <img className='status_icon' src='./assets/svg/status-pending.svg' />
          <p className='status_text'>pending to Oct 10th</p>
        </div>
        <h2 className='description_title'>Present continuous #01</h2>
        <div className='teacher'>
          <img className='teacher_picture' src='./assets/images/teacher.jpg' />
          <div className='teacher_information'>
            <p className='name'>Sonaly Araújo</p>
            <p className='date'>on Oct 05, 2022</p>
          </div>
        </div>
      </div>
    </div>
  );
}
{
  /* <div>
      <div className='exercise card'>
        <div className='description'>
          <div className='status'>
            <img
              className='status_icon'
              src='./assets/svg/status-all-done.svg'
            />
            <p className='status_text'>all done</p>
          </div>
          <h2 className='description_title'>Nothing to see here</h2>
        </div>
      </div>
      <div className='exercise card late'>
        <div
          className='cover'
          style='
              background-image: linear-gradient(
                  180deg,
                  transparent 50%,
                  var(--clr-bg) 100%
                ),
                url(http://unsplash.it/600/400);
            '
        ></div>
        <div className='description'>
          <div className='status'>
            <img className='status_icon' src='./assets/svg/status-late.svg' />
            <p className='status_text'>late</p>
          </div>
          <h2 className='description_title'>Present continuous #01</h2>
          <div className='teacher'>
            <img
              className='teacher_picture'
              src='./assets/images/teacher.jpg'
            />
            <div className='teacher_information'>
              <p className='name'>Sonaly Araújo</p>
              <p className='date'>on Sep 30, 2022</p>
            </div>
          </div>
        </div>
      </div>
      <div className='exercise card'>
        <div
          className='cover'
          style='
              background-image: linear-gradient(
                  180deg,
                  transparent 50%,
                  var(--clr-bg) 100%
                ),
                url(http://unsplash.it/600/401);
            '
        ></div>
        <div className='description'>
          <div className='status'>
            <img
              className='status_icon'
              src='./assets/svg/status-pending.svg'
            />
            <p className='status_text'>pending to Oct 10th</p>
          </div>
          <h2 className='description_title'>Present continuous #01</h2>
          <div className='teacher'>
            <img
              className='teacher_picture'
              src='./assets/images/teacher.jpg'
            />
            <div className='teacher_information'>
              <p className='name'>Sonaly Araújo</p>
              <p className='date'>on Oct 05, 2022</p>
            </div>
          </div>
        </div>
      </div>
    </div> */
}
