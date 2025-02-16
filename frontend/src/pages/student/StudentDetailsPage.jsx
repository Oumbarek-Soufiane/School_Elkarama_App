import React from 'react'
import StudentDetails from '../../components/student/StudentDetails'
import { useLoaderData } from 'react-router-dom'

function StudentDetailsPage() {
  const data = useLoaderData();
  return (
    <div>
      <StudentDetails student={data.student}/>
    </div>
  )
}

export default StudentDetailsPage
