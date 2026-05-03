import React, { useState } from 'react';
import AWS from 'aws-sdk';
import './FileUpload.css';

AWS.config.update({
  region: 'us-east-1',
  credentials: new AWS.Credentials({
    accessKeyId: process.env.REACT_APP_AWS_ACCESS_KEY_ID,
    secretAccessKey: process.env.REACT_APP_AWS_SECRET_ACCESS_KEY,
  }),
});

const s3 = new AWS.S3();

const FileUpload = () => {
  const [selectedResume, setSelectedResume] = useState(null);
  const [selectedJobDescription, setSelectedJobDescription] = useState(null);
  const [uploadStatus, setUploadStatus] = useState('');

  const handleResumeChange = (event) => {
    setSelectedResume(event.target.files[0]);
  };

  const handleJobDescriptionChange = (event) => {
    setSelectedJobDescription(event.target.files[0]);
  };

  const uploadFile = async (file, bucketName, fileNamePrefix) => {
    if (!file) {
      setUploadStatus(`Please select a file before uploading to ${fileNamePrefix}`);
      return;
    }

    const params = {
      Bucket: bucketName,
      Key: `${fileNamePrefix}/${file.name}`,
      Body: file,
      ContentType: file.type,
    };

    try {
      await s3.upload(params).promise();
      setUploadStatus(`File uploaded successfully to ${fileNamePrefix}`);
    } catch (error) {
      console.error('Upload error:', error);
      setUploadStatus(`File upload failed: ${error.message}`);
    }
  };

  return (
    <div className="upload-container">
      <h2>Resume and Job Description Upload</h2>
      
      <input type="file" accept=".pdf" onChange={handleResumeChange} />
      <button onClick={() => uploadFile(selectedResume, 'resume-upload-bucket-sweng894', 'resumes')}>
        Upload Resume
      </button>

      <input type="file" accept=".pdf" onChange={handleJobDescriptionChange} />
      <button onClick={() => uploadFile(selectedJobDescription, 'job-description-upload-bucket-sweng894', 'job-descriptions')}>
        Upload Job Description
      </button>

      {uploadStatus && <p>{uploadStatus}</p>}
    </div>
  );
};

export default FileUpload;
