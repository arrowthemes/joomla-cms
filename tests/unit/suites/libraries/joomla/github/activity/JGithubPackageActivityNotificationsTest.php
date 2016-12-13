<?php

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-01-30 at 20:06:09.
 */
class JGithubPackageActivityNotificationsTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @var    JRegistry  Options for the GitHub object.
	 * @since  11.4
	 */
	protected $options;

	/**
	 * @var    JGithubHttp  Mock client object.
	 * @since  11.4
	 */
	protected $client;

	/**
	 * @var    JHttpResponse  Mock response object.
	 * @since  12.3
	 */
	protected $response;

	/**
	 * @var JGithubPackageActivityNotifications
	 */
	protected $object;

	/**
	 * @var    string  Sample JSON string.
	 * @since  12.3
	 */
	protected $sampleString = '{"a":1,"b":2,"c":3,"d":4,"e":5}';

	/**
	 * @var    string  Sample JSON error message.
	 * @since  12.3
	 */
	protected $errorString = '{"message": "Generic Error"}';

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	protected function setUp()
	{
		parent::setUp();

		$this->options = new JRegistry;
		$this->client = $this->getMockBuilder('JGithubHttp')->setMethods(array('get', 'post', 'delete', 'patch', 'put'))->getMock();
		$this->response = $this->getMockBuilder('JHttpResponse')->getMock();

		$this->object = new JGithubPackageActivityNotifications($this->options, $this->client);
	}

	/**
	 * @covers JGithubPackageActivityNotifications::getList
	 *
	 * GET /notifications
	 *
	 * Parameters
	 *
	 * all
	 * Optional boolean true to show notifications marked as read.
	 * participating
	 * Optional boolean true to show only notifications in which the user is directly participating or mentioned.
	 * since
	 * Optional time filters out any notifications updated before the given time. The time should be passed in as UTC
	 * in the ISO 8601 format: YYYY-MM-DDTHH:MM:SSZ. Example: “2012-10-09T23:39:01Z”.
	 *
	 * Response
	 *
	 * Status: 200 OK
	 * X-RateLimit-Limit: 5000
	 * X-RateLimit-Remaining: 4999
	 */
	public function testGetList()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
		             ->method('get')
		             ->with('/notifications?&all=1&participating=1', 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->getList(),
			$this->equalTo(json_decode($this->response->body))
		)
		;
	}

	/**
	 * @covers JGithubPackageActivityNotifications::getListRepository
	 *
	 * GET /repos/:owner/:repo/notifications
	 *
	 * Parameters
	 *
	 * all
	 * Optional boolean true to show notifications marked as read.
	 * participating
	 * Optional boolean true to show only notifications in which the user is directly participating or mentioned.
	 * since
	 * Optional time filters out any notifications updated before the given time. The time should be passed in as UTC
	 * in the ISO 8601 format: YYYY-MM-DDTHH:MM:SSZ. Example: “2012-10-09T23:39:01Z”.
	 *
	 * Response
	 *
	 * Status: 200 OK
	 * X-RateLimit-Limit: 5000
	 * X-RateLimit-Remaining: 4999
	 */
	public function testGetListRepository()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
		             ->method('get')
		             ->with('/repos/joomla/joomla-platform/notifications?&all=1&participating=1', 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->getListRepository('joomla', 'joomla-platform'),
			$this->equalTo(json_decode($this->response->body))
		)
		;
	}

	/**
	 * @covers JGithubPackageActivityNotifications::markRead
	 *
	 * PUT /notifications
	 *
	 * Input
	 *
	 * unread
	 * Boolean Changes the unread status of the threads.
	 * read
	 * Boolean Inverse of “unread”.
	 * last_read_at
	 * Optional Time Describes the last point that notifications were checked. Anything updated since this time will
	 * not be updated. Default: Now. Expected in ISO 8601 format: YYYY-MM-DDTHH:MM:SSZ. Example:
	 * “2012-10-09T23:39:01Z”.
	 *
	 * Response
	 *
	 * Status: 205 Reset Content
	 * X-RateLimit-Limit: 5000
	 * X-RateLimit-Remaining: 4999
	 */
	public function testMarkRead()
	{
		$this->response->code = 205;
		$this->response->body = '';

		$this->client->expects($this->once())
		             ->method('put')
		             ->with('/notifications', '{"unread":true,"read":true}', 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->markRead(),
			$this->equalTo($this->response->body)
		)
		;
	}

	public function testMarkReadLastRead()
	{
		$this->response->code = 205;
		$this->response->body = '';

		$date = new JDate('1966-09-14');
		$data = '{"unread":true,"read":true,"last_read_at":"1966-09-14T00:00:00+00:00"}';

		$this->client->expects($this->once())
		             ->method('put')
		             ->with('/notifications', $data, 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->markRead(true, true, $date),
			$this->equalTo($this->response->body)
		)
		;
	}

	/**
	 * @covers JGithubPackageActivityNotifications::markReadRepository
	 *
	 * PUT /repos/:owner/:repo/notifications
	 *
	 * Input
	 *
	 * unread
	 * Boolean Changes the unread status of the threads.
	 * read
	 * Boolean Inverse of “unread”.
	 * last_read_at
	 * Optional Time Describes the last point that notifications were checked. Anything updated since this time will
	 * not be updated. Default: Now. Expected in ISO 8601 format: YYYY-MM-DDTHH:MM:SSZ. Example:
	 * “2012-10-09T23:39:01Z”.
	 *
	 * Response
	 *
	 * Status: 205 Reset Content
	 * X-RateLimit-Limit: 5000
	 * X-RateLimit-Remaining: 4999
	 */
	public function testMarkReadRepository()
	{
		$this->response->code = 205;
		$this->response->body = '';

		$data = '{"unread":true,"read":true}';

		$this->client->expects($this->once())
		             ->method('put')
		             ->with('/repos/joomla/joomla-platform/notifications', $data, 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->markReadRepository('joomla', 'joomla-platform', true, true),
			$this->equalTo($this->response->body)
		)
		;
	}

	public function testMarkReadRepositoryLastRead()
	{
		$this->response->code = 205;
		$this->response->body = '';

		$date = new JDate('1966-09-14');
		$data = '{"unread":true,"read":true,"last_read_at":"1966-09-14T00:00:00+00:00"}';

		$this->client->expects($this->once())
		             ->method('put')
		             ->with('/repos/joomla/joomla-platform/notifications', $data, 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->markReadRepository('joomla', 'joomla-platform', true, true, $date),
			$this->equalTo($this->response->body)
		)
		;
	}

	/**
	 * @covers JGithubPackageActivityNotifications::viewThread
	 *
	 *     GET /notifications/threads/:id
	 *
	 * Response
	 *
	 * Status: 200 OK
	 * X-RateLimit-Limit: 5000
	 * X-RateLimit-Remaining: 4999


	 */
	public function testViewThread()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
		             ->method('get')
		             ->with('/notifications/threads/1', 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->viewThread(1),
			$this->equalTo(json_decode($this->response->body))
		)
		;
	}

	/**
	 * @covers JGithubPackageActivityNotifications::markReadThread
	 *
	 *     PATCH /notifications/threads/:id
	 *
	 * Input
	 *
	 * unread
	 * Boolean Changes the unread status of the threads.
	 * read
	 * Boolean Inverse of “unread”.
	 *
	 * Response
	 *
	 * Status: 205 Reset Content
	 * X-RateLimit-Limit: 5000
	 * X-RateLimit-Remaining: 4999

	 */
	public function testMarkReadThread()
	{
		$this->response->code = 205;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
		             ->method('patch')
		             ->with('/notifications/threads/1', '{"unread":true,"read":true}', 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->markReadThread(1),
			$this->equalTo(json_decode($this->response->body))
		)
		;
	}

	/**
	 * @covers JGithubPackageActivityNotifications::getThreadSubscription
	 *
	 *     GET /notifications/threads/1/subscription
	 *
	 * Response
	 *
	 * Status: 200 OK
	 * X-RateLimit-Limit: 5000
	 * X-RateLimit-Remaining: 4999


	 */
	public function testGetThreadSubscription()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
		             ->method('get')
		             ->with('/notifications/threads/1/subscription', 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->getThreadSubscription(1),
			$this->equalTo(json_decode($this->response->body))
		)
		;
	}

	/**
	 * @covers JGithubPackageActivityNotifications::setThreadSubscription
	 *
	 *     PUT /notifications/threads/1/subscription
	 *
	 * Input
	 *
	 * subscribed
	 * boolean Determines if notifications should be received from this thread.
	 * ignored
	 * boolean Determines if all notifications should be blocked from this thread.
	 *
	 * Response
	 *
	 * Status: 200 OK
	 * X-RateLimit-Limit: 5000
	 * X-RateLimit-Remaining: 4999



	 */
	public function testSetThreadSubscription()
	{
		$this->response->code = 200;
		$this->response->body = $this->sampleString;

		$this->client->expects($this->once())
		             ->method('put')
		             ->with('/notifications/threads/1/subscription', '{"subscribed":true,"ignored":false}', 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->setThreadSubscription(1, true, false),
			$this->equalTo(json_decode($this->response->body))
		)
		;
	}

	/**
	 * @covers JGithubPackageActivityNotifications::deleteThreadSubscription
	 *
	 *     DELETE /notifications/threads/1/subscription
	 *
	 * Response
	 *
	 * Status: 204 No Content
	 * X-RateLimit-Limit: 5000
	 * X-RateLimit-Remaining: 4999

	 */
	public function testDeleteThreadSubscription()
	{
		$this->response->code = 204;
		$this->response->body = '';

		$this->client->expects($this->once())
		             ->method('delete')
		             ->with('/notifications/threads/1/subscription', 0, 0)
		             ->will($this->returnValue($this->response))
		;

		$this->assertThat(
			$this->object->deleteThreadSubscription(1),
			$this->equalTo(json_decode($this->response->body))
		)
		;
	}
}
